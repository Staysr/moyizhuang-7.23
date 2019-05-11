export default {
    props: {},
    data() {
        return {
            markers: {
                data: [],
                car: (h, { extData }) => {
                    return (
                        <span class="marker-car">
                            <i class=" ivu-icon ivu-icon-ios-car"> </i>
                        </span>
                    );
                },
                warehouse: (h, { extData }) => {
                    return <span class="marker-warehouse">仓</span>;
                },
                delivery: (h, { extData }) => {
                    if (extData.status == 0) {
                        return (
                            <span class="marker-delivery yellow">
                                {extData.sort}
                            </span>
                        );
                    } else if (extData.status == 1) {
                        return (
                            <span class="marker-delivery green">
                                {extData.sort}
                            </span>
                        );
                    } else {
                        return (
                            <span class="marker-delivery red">
                                {extData.sort}
                            </span>
                        );
                    }
                }
            }
        };
    },
};
