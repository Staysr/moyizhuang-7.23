<template>
    <div class="dropdown" @click="onClick">
        <slot></slot>
    </div>
</template>

<script>
    import Popper from 'popper.js/dist/umd/popper.js'
    export default {
        name: 'Drop',
        props: {
            className: {
                type: String
            }
        },
        data () {
            return {
                popper: null,
                width: '',
                popperStatus: false,
            };
        },
        methods: {
            onClick(){
                this.$emit('on-click')
            },
            update () {
                if(this.popoper){
                    this.$nextTick(() => {
                        this.popper.update();
                        this.popperStatus = true;
                    });
                }else {
                    this.$nextTick(() => {
                        this.popper = new Popper(this.$parent.$refs.reference, this.$el, {
                            placement: 'up',
                            modifiers: {
                                computeStyle: {
                                    gpuAcceleration: false
                                },
                                preventOverflow: {
                                    boundariesElement: 'window'
                                }
                            },
                            onCreate: () => {
                                this.resetTransformOrigin();
                                this.$nextTick(this.popper.update());
                            },
                            onUpdate: () => {
                                this.resetTransformOrigin();
                            }
                        });
                    })
                }
            },
            resetTransformOrigin() {
                // 不判断，Select 会报错，不知道为什么
                if (!this.popper) return;

                let x_placement = this.popper.popper.getAttribute('x-placement');
                let placementStart = x_placement.split('-')[0];
                let placementEnd = x_placement.split('-')[1];
                const leftOrRight = x_placement === 'left' || x_placement === 'right';
                if(!leftOrRight){
                    this.popper.popper.style.transformOrigin = placementStart==='bottom' || ( placementStart !== 'top' && placementEnd === 'start') ? 'center top' : 'center bottom';
                }
                this.popper.popper.style.left = 0

            },
            destroy () {
                if (this.popper) {
                    setTimeout(() => {
                        if (this.popper && !this.popperStatus) {
                            this.popper.destroy();
                            this.popper = null;
                        }
                        this.popperStatus = false;
                    }, 300);
                }
            }
        },
        created () {
            this.$on('on-update-popper', this.update);
            this.$on('on-destroy-popper', this.destroy);
        },
        beforeDestroy () {
            if (this.popper) {
                this.popper.destroy();
            }
        }
    }
</script>

<style scoped>

</style>