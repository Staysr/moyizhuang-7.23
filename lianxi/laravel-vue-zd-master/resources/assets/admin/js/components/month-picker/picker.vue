<template>
    <div
        :class="wrapperClasses"
        v-click-outside:mousedown.capture="handleClose"
        v-click-outside.capture="handleClose"
    >
        <div ref="reference" :class="[prefixCls + '-rel']">
            <slot>
                <i-input
                    :key="forceInputRerender"
                    :element-id="elementId"
                    :class="[prefixCls + '-editor']"
                    :readonly="!editable || readonly"
                    :disabled="disabled"
                    :size="size"
                    :placeholder="placeholder"
                    :value="visualValue"
                    :name="name"
                    ref="input"

                    @on-input-change="handleInputChange"
                    @on-focus="handleFocus"
                    @on-blur="handleBlur"
                    @on-click="handleIconClick"
                    @click.native="handleFocus"
                    @mouseenter.native="handleInputMouseenter"
                    @mouseleave.native="handleInputMouseleave"

                    :icon="iconType"
                ></i-input>
            </slot>
        </div>
        <transition name="transition-drop">
            <Drop
                v-show="opened"
                :placement="placement"
                ref="drop">
                <div>
                    <component
                        :is="panel"
                        ref="pickerPanel"
                        :visible="visible"
                        :showTime="type === 'datetime'"
                        :confirm="isConfirm"
                        :selectionMode="selectionMode"
                        :steps="steps"
                        :format="format"
                        :value="internalValue"
                        :start-date="startDate"
                        :split-panels="splitPanels"
                        :picker-type="type"
                        :focused-date="focusedDate"
                        :time-picker-options="timePickerOptions"
                        
                        v-bind="ownPickerProps"

                        @on-pick="onPick"
                        @on-pick-clear="handleClear"
                        @on-pick-success="onPickSuccess"
                        @on-pick-click="disableClickOutSide = true"
                        @on-selection-mode-change="onSelectionModeChange"
                    ></component>
                </div>
            </Drop>
        </transition>
    </div>
</template>

<script>
    import {directive as clickOutside} from 'v-click-outside-x';
    import { oneOf, findComponentsDownward } from 'iview/src/utils/assist';
    import { DEFAULT_FORMATS, RANGE_SEPARATOR, TYPE_VALUE_RESOLVER_MAP, getDayCountOfMonth } from './util';
    import Emitter from 'iview/src/mixins/emitter';
    import Drop from "iview/src/components/select/dropdown";

    const prefixCls = 'ivu-date-picker';
    const pickerPrefixCls = 'ivu-picker';

    const isEmptyArray = val => val.reduce((isEmpty, str) => isEmpty && !str || (typeof str === 'string' && str.trim() === ''), true);

    const pulseElement = (el) => {
        const pulseClass = 'ivu-date-picker-btn-pulse';
        el.classList.add(pulseClass);
        setTimeout(() => el.classList.remove(pulseClass), 200);
    };

    export default {
        components: {Drop},
        mixins: [ Emitter ],
        directives: { clickOutside },
        props: {
            format: {
                type: String
            },
            readonly: {
                type: Boolean,
                default: false
            },
            disabled: {
                type: Boolean,
                default: false
            },
            editable: {
                type: Boolean,
                default: true
            },
            clearable: {
                type: Boolean,
                default: true
            },
            confirm: {
                type: Boolean,
                default: false
            },
            open: {
                type: Boolean,
                default: null
            },
            timePickerOptions: {
                default: () => ({}),
                type: Object,
            },
            splitPanels: {
                type: Boolean,
                default: false
            },
            startDate: {
                type: Date
            },
            size: {
                validator (value) {
                    return oneOf(value, ['small', 'large', 'default']);
                },
                default () {
                    return this.$IVIEW.size === '' ? 'default' : this.$IVIEW.size;
                }
            },
            placeholder: {
                type: String,
                default: ''
            },
            placement: {
                validator (value) {
                    return oneOf(value, ['top', 'top-start', 'top-end', 'bottom', 'bottom-start', 'bottom-end', 'left', 'left-start', 'left-end', 'right', 'right-start', 'right-end']);
                },
                default: 'bottom-start'
            },
            name: {
                type: String
            },
            elementId: {
                type: String
            },
            steps: {
                type: Array,
                default: () => []
            },
            value: {
                type: [Date, String, Array]
            },
            options: {
                type: Object,
                default: () => ({})
            }
        },
        data(){
            const isRange = this.type.includes('range');
            const emptyArray = isRange ? [null, null] : [null];
            const initialValue = isEmptyArray((isRange ? this.value : [this.value]) || []) ? emptyArray : this.parseDate(this.value);

            return {
                prefixCls: prefixCls,
                showClose: false,
                visible: false,
                internalValue: initialValue,
                disableClickOutSide: false,    // fixed when click a date,trigger clickoutside to close picker
                selectionMode: this.onSelectionModeChange(this.type),
                forceInputRerender: 1,
                isFocused: false,
                focusedDate: initialValue[0] || this.startDate || new Date(),
                focusedTime: {
                    column: 0, // which column inside the picker
                    picker: 0, // which picker
                    active: false
                },
                internalFocus: false,
            };
        },
        computed: {
            wrapperClasses(){
                return [prefixCls, {
                    [prefixCls + '-focused']: this.isFocused
                }];
            },
            publicVModelValue(){
                if (!this.multiple){
                    const isRange = this.type.includes('range');
                    let val = this.internalValue.map(date => date instanceof Date ? new Date(date) : (date || ''));

                    if (this.type.match(/^time/)) val = val.map(this.formatDate);
                    return (isRange || this.multiple) ? val : val[0];
                }
            },
            publicStringValue(){
                const {formatDate, publicVModelValue, type} = this;
                if (type.match(/^time/)) return publicVModelValue;
                if (this.multiple) return formatDate(publicVModelValue);
                return Array.isArray(publicVModelValue) ? publicVModelValue.map(formatDate) : formatDate(publicVModelValue);
            },
            opened () {
                return this.open === null ? this.visible : this.open;
            },
            iconType () {
                let icon = 'ios-calendar-outline';
                if (this.showClose) icon = 'ios-close-circle';
                return icon;
            },
            transition () {
                const bottomPlaced = this.placement.match(/^bottom/);
                return bottomPlaced ? 'slide-up' : 'slide-down';
            },
            visualValue() {
                return this.formatDate(this.internalValue);
            },
            isConfirm(){
                return this.confirm || this.type === 'datetime' || this.type === 'datetimerange' || this.multiple;
            }
        },
        methods: {
            onSelectionModeChange(type){ 
                // 匹配月
                if (type.match(/^date/)) type = 'month';
                this.selectionMode = oneOf(type, ['year', 'month', 'date']) && type;
                return this.selectionMode;
            },
            handleClose (e) {
                if (e && e.type === 'mousedown' && this.visible) {
                    e.preventDefault();
                    e.stopPropagation();
                    return;
                }

                if (this.visible) {
                    const pickerPanel = this.$refs.pickerPanel && this.$refs.pickerPanel.$el;
                    if (e && pickerPanel && pickerPanel.contains(e.target)) return; // its a click inside own component, lets ignore it.

                    this.visible = false;
                    e && e.preventDefault();
                    e && e.stopPropagation();
                    return;
                }

                this.isFocused = false;
                this.disableClickOutSide = false;
            },
            handleFocus (e) {
                if (this.readonly) return;
                this.isFocused = true;
                if (e && e.type === 'focus') return;
                this.visible = true;
            },
            handleBlur (e) {
                if (this.internalFocus){
                    this.internalFocus = false;
                    return;
                }
                if (this.visible) {
                    e.preventDefault();
                    return;
                }

                this.isFocused = false;
                this.onSelectionModeChange(this.type);
                this.internalValue = this.internalValue.slice(); // trigger panel watchers to reset views
                this.reset();
                this.$refs.pickerPanel.onToggleVisibility(false);

            },
            reset(){
                this.$refs.pickerPanel.reset && this.$refs.pickerPanel.reset();
            },
            handleInputChange (event) {
                const isArrayValue = this.type.includes('range') || this.multiple;
                const oldValue = this.visualValue;
                const newValue = event.target.value;
                const newDate = this.parseDate(newValue);
                const disabledDateFn =
                    this.options &&
                    typeof this.options.disabledDate === 'function' &&
                    this.options.disabledDate;
                const valueToTest = isArrayValue ? newDate : newDate[0];
                const isDisabled = disabledDateFn && disabledDateFn(valueToTest);
                const isValidDate = newDate.reduce((valid, date) => valid && date instanceof Date, true);

                if (newValue !== oldValue && !isDisabled && isValidDate) {
                    this.emitChange(this.type);
                    this.internalValue = newDate;
                } else {
                    this.forceInputRerender++;
                }
            },
            handleInputMouseenter () {
                if (this.readonly || this.disabled) return;
                if (this.visualValue && this.clearable) {
                    this.showClose = true;
                }
            },
            handleInputMouseleave () {
                this.showClose = false;
            },
            handleIconClick () {
                if (this.showClose) {
                    this.handleClear();
                } else if (!this.disabled) {
                    this.handleFocus();
                }
            },
            handleClear () {
                this.visible = false;
                this.internalValue = this.internalValue.map(() => null);
                this.$emit('on-clear');
                this.dispatch('FormItem', 'on-form-change', '');
                this.emitChange(this.type);
                this.reset();

                setTimeout(
                    () => this.onSelectionModeChange(this.type),
                    500 // delay to improve dropdown close visual effect
                );
            },
            emitChange (type) {
                this.$nextTick(() => {
                    this.$emit('on-change', this.publicStringValue, type);
                    this.dispatch('FormItem', 'on-form-change', this.publicStringValue);
                });
            },
            parseDate(val) {
                const isRange = this.type.includes('range');
                const type = this.type;
                const parser = (
                    TYPE_VALUE_RESOLVER_MAP[type] ||
                    TYPE_VALUE_RESOLVER_MAP['default']
                ).parser;
                const format = this.format || DEFAULT_FORMATS[type];
                const multipleParser = TYPE_VALUE_RESOLVER_MAP['multiple'].parser;

                if (val && type === 'time' && !(val instanceof Date)) {
                    val = parser(val, format);
                } else if (this.multiple && val) {
                    val = multipleParser(val, format);
                } else if (isRange) {
                    if (!val){
                        val = [null, null];
                    } else {
                        if (typeof val === 'string') {
                            val = parser(val, format);
                        } else if (type === 'timerange') {
                            val = parser(val, format).map(v => v || '');
                        } else {
                            const [start, end] = val;
                            if (start instanceof Date && end instanceof Date){
                                val = val.map(date => new Date(date));
                            } else if (typeof start === 'string' && typeof end === 'string'){
                                val = parser(val.join(RANGE_SEPARATOR), format);
                            } else if (!start || !end){
                                val = [null, null];
                            }
                        }
                    }
                } else if (typeof val === 'string' && type.indexOf('time') !== 0){
                    val = parser(val, format) || null;
                }

                return (isRange || this.multiple) ? (val || []) : [val];
            },
            formatDate(value){
                const format = DEFAULT_FORMATS[this.type];

                if (this.multiple) {
                    const formatter = TYPE_VALUE_RESOLVER_MAP.multiple.formatter;
                    return formatter(value, this.format || format);
                } else {
                    const {formatter} = (
                        TYPE_VALUE_RESOLVER_MAP[this.type] ||
                        TYPE_VALUE_RESOLVER_MAP['default']
                    );
                    return formatter(value, this.format || format);
                }
            },
            onPick(dates, visible = false, type) {
                if (this.multiple){
                    const pickedTimeStamp = dates.getTime();
                    const indexOfPickedDate = this.internalValue.findIndex(date => date && date.getTime() === pickedTimeStamp);
                    const allDates = [...this.internalValue, dates].filter(Boolean);
                    const timeStamps = allDates.map(date => date.getTime()).filter((ts, i, arr) => arr.indexOf(ts) === i && i !== indexOfPickedDate); // filter away duplicates
                    this.internalValue = timeStamps.map(ts => new Date(ts));
                } else {
                    this.internalValue = Array.isArray(dates) ? dates : [dates];
                }

                if (this.internalValue[0]) this.focusedDate = this.internalValue[0];

                if (!this.isConfirm) this.onSelectionModeChange(this.type); // reset the selectionMode
                if (!this.isConfirm) this.visible = visible;
                this.emitChange(type);
            },
            onPickSuccess(){
                this.visible = false;
                this.$emit('on-ok');
                this.focus();
                this.reset();
            },
            focus() {
                this.$refs.input && this.$refs.input.focus();
            }
        },
        watch: {
            visible (state) {
                if (state === false){
                    this.$refs.drop.destroy();
                }
                this.$refs.drop.update();
                this.$emit('on-open-change', state);
            },
            value(val) {
                this.internalValue = this.parseDate(val);
            },
            open (val) {
                this.visible = val === true;
            },
            type(type){
                this.onSelectionModeChange(type);
            },
            publicVModelValue(now, before){
                const newValue = JSON.stringify(now);
                const oldValue = JSON.stringify(before);
                const shouldEmitInput = newValue !== oldValue || typeof now !== typeof before;
                if (shouldEmitInput) this.$emit('input', now); // to update v-model
            },
        },
        mounted () {
            const initialValue = this.value;
            const parsedValue = this.publicVModelValue;
            if (typeof initialValue !== typeof parsedValue || JSON.stringify(initialValue) !== JSON.stringify(parsedValue)){
                this.$emit('input', this.publicVModelValue); // to update v-model
            }
            if (this.open !== null) this.visible = this.open;

            // to handle focus from confirm buttons
            this.$on('focus-input', () => this.focus());
        }
    };
</script>
