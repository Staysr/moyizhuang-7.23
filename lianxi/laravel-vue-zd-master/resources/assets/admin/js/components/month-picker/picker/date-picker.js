import Picker from '../picker.vue';
import RangeDatePickerPanel from '../panel/date-range.vue';

import { oneOf } from 'iview/src/utils/assist';

export default {
    name: 'CalendarPicker',
    mixins: [Picker],
    props: {
        type: {
            validator (value) {
                return oneOf(value, ['year', 'month', 'date', 'daterange']);
            },
            default: 'month'
        },
    },
    components: { RangeDatePickerPanel },
    computed: {
        panel(){
            const isRange =  this.type === 'daterange';
            return isRange ? 'RangeDatePickerPanel' : '';
        },
        ownPickerProps(){
            return this.options;
        }
    },
};
