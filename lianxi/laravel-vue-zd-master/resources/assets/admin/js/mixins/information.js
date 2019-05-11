export default {
    props: {},
    data() {
        return {
            content: "",
            position: "",
            status_res: {
                0: "待配送",
                1: "已妥投",
                2: "未妥投"
            },
            windowEvents: {
                close: () => {
                    this.position = "";
                }
            },
            information(cont) {
                if (cont.vid == "car-marker") {
                    this.position = cont.extData.position.location;
                    this.content = `<div class="amap-window">
                                <h6>${cont.extData.position.address}</h6>
                                <dl>
                                    <dd>
                                        <strong>仓名称:</strong>
                                        <span>
                                            ${cont.extData.warehouse.title}
                                        </span>
                                    </dd>
                                    <dd>
                                        <strong>司机姓名:</strong>
                                        <span>
                                            ${cont.extData.driver.name}
                                        </span>
                                    </dd>
                                    <dd>
                                        <strong>联系电话:</strong>
                                        <span>
                                            ${cont.extData.driver.phone}
                                        </span>
                                    </dd>
                                    <dd>
                                        <strong>车牌号:</strong>
                                        <span>
                                            ${cont.extData.driver.car_number}
                                        </span>
                                    </dd>
                                    <dd>
                                        <strong>定位时间:</strong>
                                        <span>
                                            ${cont.extData.position.createTime}
                                        </span>
                                    </dd>
                                </dl>
                            </div>`;
                } else if (cont.vid == "warehouse-marker") {
                    this.position = cont.extData.location;
                    this.content = `                    <div class="amap-window">
                        <h6>${cont.extData.address}</h6>
                        <dl>
                            <dd>
                                <strong>联系人:</strong>
                                <span>${cont.extData.contacts}</span>
                            </dd>
                            <dd>
                                <strong>联系电话:</strong>
                                <span>${cont.extData.contacts_phone}</span>
                            </dd>
                        </dl>
                    </div>`;
                } else {
                    this.position = cont.extData.location;
                    this.content = `                    <div class="amap-window">
                        <h6>
                            ${cont.extData.task.name}
                        </h6>
                        <dl>
                            <dd>
                                <strong>联系人:</strong>
                                <span>${cont.extData.contacts}</span>
                            </dd>
                            <dd>
                                <strong>联系电话:</strong>
                                <span>${cont.extData.contact_way}</span>
                            </dd>
                            <dd>
                                <strong>妥投结果:</strong>
                                <span>${
                        this.status_res[cont.extData.status]
                        }</span>
                            </dd>
                            <dd>
                                <strong>妥投时间:</strong>
                                <span>${
                        cont.extData.finish_time == null
                            ? "-"
                            : cont.extData.finish_time
                        }</span>
                            </dd>
                            <dd>
                                <strong>妥投点:</strong>
                                <span>${cont.extData.name}</span>
                            </dd>
                            <dd>
                                <h6>
                                    <span style="background-color: #2d8cf0;padding:2px;color:#fff">${
                        cont.extData.task.type == 1
                            ? "主"
                            : "临"
                        }</span>
                                    ${cont.extData.task.name}
                                </h6>
                            </dd>
                            <dd>
                                <strong>司机姓名:</strong>
                                <span>${cont.extData.driver.name}</span>
                            </dd>
                            <dd>
                                <strong>联系电话:</strong>
                                <span>${cont.extData.driver.phone}</span>
                            </dd>
                        </dl>
                    </div>`;
                }
            }
        };
    },
};
