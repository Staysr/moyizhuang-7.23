<template>
    <div :class="classes">
        <span
            :class="getCellCls(cell)"
            v-for="cell in cells"
            :key="cell.text"
            @click="handleClick(cell)"
            @mouseenter="handleMouseMove(cell)">
            <em>{{ cell.text }}</em>
        </span>
    </div>
</template>

<script>
    import { clearHours,isInRange  } from '../util';
    import { deepCopy } from 'iview/src/utils/assist';
    import Locale from 'iview/src/mixins/locale';
    import mixin from './mixin';
    import prefixCls from './prefixCls';

    export default {
        mixins: [ Locale, mixin ],
        props: {/* in mixin */},
        data() {
            const [minMonth, maxMonth] = this.value.map(month => month);
            return {}
        },
        computed: {
            classes() {
                return [
                    `${prefixCls}`,
                    `${prefixCls}-month`
                ];
            },
            cells () {
                let cells = [];
                const cell_tmpl = {
                    text: '',
                    selected: false
                    // disabled: false
                };

                // tableDate 完整年月日时间
                const tableYear = this.tableDate.getFullYear();  // 当前面板年2018
                const selectedDays = this.dates.filter(Boolean).map(date => clearHours(new Date(date.getFullYear(), date.getMonth(), 1)));
                const [minMonth, maxMonth] = this.dates.map(clearHours);  
                const focusedDate = clearHours(new Date(this.focusedDate.getFullYear(), this.focusedDate.getMonth(), 1));
                // mixin 
                const rangeStart = this.rangeState.from && clearHours(this.rangeState.from);
                const rangeEnd = this.rangeState.to && clearHours(this.rangeState.to);

                for (let i = 0; i < 12; i++) {
                    const cell = deepCopy(cell_tmpl);
                    cell.date = new Date(tableYear, i, 1);  // Mon Jan 01 2018 00:00:00 GMT+0800 (中国标准时间)
                    cell.text = this.tCell(i + 1);  // 左右两边的1月-12月
                    const day = clearHours(cell.date);  // 1514736000000
                    const month = clearHours(cell.text);

                    // 头尾选中月份 没有range，只有selected
                    cell.start = day === minMonth;
                    cell.end = day === maxMonth;

                    cell.disabled = typeof this.disabledDate === 'function' && this.disabledDate(cell.date.getFullYear(), cell.date.getMonth() + 1);
                    cell.selected = selectedDays.includes(day);
                    cell.focused = month === focusedDate;
                    cell.range = isInRange(cell.date, rangeStart, rangeEnd);
                    cells.push(cell);
                }
                    
                return cells;
            }
        },
        methods: {
            getCellCls (cell) {
                return [
                    `${prefixCls}-cell`,
                    {
                        [`${prefixCls}-cell-selected`]: cell.selected && !cell.disabled, 
                        [`${prefixCls}-cell-disabled`]: cell.disabled,
                        [`${prefixCls}-cell-focused`]: clearHours(cell.date) === clearHours(this.focusedDate) && !cell.disabled,
                        [`${prefixCls}-cell-range`]: cell.range && !cell.start && !cell.end && !cell.disabled
                    }
                ];
            },
            tCell (nr) {
                return this.t(`i.datepicker.months.m${nr}`);
            }
        }
    };
</script>
