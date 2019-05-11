<template>
  <div :class="classes" @mousedown.prevent>
    <div :class="panelBodyClasses">
      <div :class="[prefixCls + '-content']">
          <div :class="[datePrefixCls + '-header']">
              <span
                  :class="iconBtnCls('prev', '-double')"
                  @click="prevYear('left')"><Icon type="ios-arrow-back"></Icon></span>
              <date-panel-label
                  :date-panel-label="leftDatePanelLabel"
                  :current-view="leftDatePanelView"
                  :date-prefix-cls="datePrefixCls"></date-panel-label>
              <span
              :class="iconBtnCls('next', '-double')"
              @click="nextYear('right')"><Icon type="ios-arrow-forward"></Icon></span>
          </div>
          <component
              :is="leftPickerTable"
              ref="leftYearTable"
              :table-date="leftPanelDate"
              selection-mode="range"
              :disabled-date="disabledDate"
              :range-state="rangeState"
              :value="preSelecting.left ? [dates[0]] : dates"
              :focused-date="focusedDate"

              @on-change-range="handleChangeRange"
              @on-pick="panelPickerHandlers.left"
              @on-pick-click="handlePickClick"
          ></component>
      </div>
    </div>
  </div>
</template>

<script>
import YearTable from "../base/year-table.vue";
import MonthTable from "../base/month-table.vue";
import Confirm from "../base/confirm.vue";
import { toDate, initTimeDate, formatDateLabels } from "../util";
import datePanelLabel from "./date-panel-label.vue";
import Mixin from "./panel-mixin";
import DateMixin from "./date-panel-mixin";
import Locale from "iview/src/mixins/locale";

const prefixCls = "ivu-picker-panel";
const datePrefixCls = "ivu-date-picker";
const dateSorter = (a, b) => {
  if (!a || !b) return 0;
  return a.getTime() - b.getTime();
};

export default {
  name: "RangeDatePickerPanel",
  mixins: [Mixin, Locale, DateMixin],
  components: { YearTable, MonthTable, Confirm, datePanelLabel },
  props: {
    // more props in the mixin
    splitPanels: {
      type: Boolean,
      default: false
    }
  },
  data() {
    const [minMonth, maxMonth] = this.value.map(date => date || initTimeDate());
    const leftPanelDate = this.startDate ? this.startDate : minMonth;
    return {
      prefixCls: prefixCls,
      datePrefixCls: datePrefixCls,
      dates: this.value,
      rangeState: {
        from: this.value[0],
        to: this.value[1],
        selecting: minMonth && !maxMonth
      },
      currentView: this.selectionMode || "range",
      leftPickerTable: `${this.selectionMode}-table`,
      leftPanelDate: leftPanelDate
    };
  },
  computed: {
    classes() {
      return [
        `${prefixCls}-body-wrapper`,
        `${datePrefixCls}-with-monthrange`
      ];
    },
    panelBodyClasses() {
      return [
        prefixCls + "-body",
        {
          [prefixCls + "-body-date"]: !this.showTime
        }
      ];
    },
    leftDatePanelLabel() {
      return this.panelLabelConfig("left");
    },
    leftDatePanelView() {
      return this.leftPickerTable.split("-").shift();
    },
    timeDisabled() {
      return !(this.dates[0] && this.dates[1]);
    },
    preSelecting() {
      const tableType = `${this.currentView}-table`;
      return {
        left: this.leftPickerTable !== tableType
      };
    },
    panelPickerHandlers() {
      return {
        left: this.preSelecting.left
          ? this.handlePreSelection.bind(this, "left")
          : this.handleRangePick
      };
    }
  },
  watch: {
    value(newVal) {
      const minMonth = newVal[0] ? toDate(newVal[0]) : null;
      const maxMonth = newVal[1] ? toDate(newVal[1]) : null;
      this.dates = [minMonth, maxMonth].sort(dateSorter);
      this.rangeState = {
        from: this.dates[0],
        to: this.dates[1],
        selecting: false
      };
    },
    currentView(currentView) {
      const leftMonth = this.leftPanelDate.getMonth();
      if (currentView === "month") {
        this.changePanelDate("", "FullYear", 1);
      }
      if (currentView === "year") {
        this.changePanelDate("", "FullYear", 10);
      }
    },
    selectionMode(type) {
      this.currentView = type || "range";
    }
  },
  methods: {
    reset() {
      this.currentView = this.selectionMode;
      this.leftPickerTable = `${this.currentView}-table`;
    },
    panelLabelConfig(direction) {
      const locale = this.t("i.locale");
      const datePanelLabel = this.t("i.datepicker.datePanelLabel");
      const handler = type => {
        // 显示当前是年 还是月 的面板
        const fn = type == "month" ? this.showMonthPicker : this.showYearPicker;
        return () => fn(direction);
      };
      const date = this[`${direction}PanelDate`];
      const { labels, separator } = formatDateLabels(
        locale,
        datePanelLabel,
        date
      );
      return {
        separator: separator,
        labels: labels.map(obj => ((obj.handler = handler(obj.type)), obj))
      };
    },
    prevYear(panel) {
      const increment = this.currentView === "year" ? -10 : -1;
      this.changePanelDate(panel, "FullYear", increment);
    },
    nextYear(panel) {
      const increment = this.currentView === "year" ? 10 : 1;
      this.changePanelDate(panel, "FullYear", increment);
    },
    // 左右箭头 改变年份
    changePanelDate(panel, type, increment, updateOtherPanel = true) {
      const current = new Date(this[`${panel}PanelDate`]);
      current[`set${type}`](current[`get${type}`]() + increment);
      this[`${panel}PanelDate`] = current;
      if (!updateOtherPanel) return;

      if (!this.splitPanels) {
        const otherPanel = panel === "left" ? "right" : "left";
        const otherCurrent = new Date(this[`${otherPanel}PanelDate`]);
        otherCurrent[`set${type}`](otherCurrent[`get${type}`]() + increment);
        this[`${otherPanel}PanelDate`] = otherCurrent;
      }
    },
    showYearPicker(panel) {
      this[`${panel}PickerTable`] = "year-table";
    },
    showMonthPicker(panel) {
      this[`${panel}PickerTable`] = "month-table";
    },
    handlePreSelection(panel, value) {
      this[`${panel}PanelDate`] = value;
      const currentViewType = this[`${panel}PickerTable`];
      if (currentViewType === "year-table") {
        this[`${panel}PickerTable`] = "month-table";
      }
      if (!this.splitPanels) {
        const otherPanel = panel === "left" ? "right" : "left";
        this[`${otherPanel}PanelDate`] = value;
        this.changePanelDate(otherPanel, "Month", 1, false);
      }
    },
    handleRangePick(val, type) {
      if (this.rangeState.selecting) {
        const [minMonth, maxMonth] = [this.rangeState.from, val].sort(dateSorter);
        this.dates = [minMonth, maxMonth];
        this.rangeState = {
          from: minMonth,
          to: maxMonth,
          selecting: false
        }
        this.handleConfirm(false, type || "date");
      } else {
        this.rangeState = {
          from: val,
          to: null,
          selecting: true
        };
      }
    },
    handleChangeRange(val) {
      this.rangeState.to = val;
    }
  }
};
</script>