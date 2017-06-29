<template>
    <div class="col-sm-12">
            <h3>Preferences</h3>

            <div class="row">
                <div class="col-xs-12">
                    <label for="inventory_control_method">Inventory Control Method</label>
                    <select @change="updateSettings()" id="inventory_control_method" v-model="settings.inventory_control_method" class="form-control">
                        <option value="None">None</option>
                        <option value="FIFO">FIFO</option>
                        <option value="LIFO">LIFO</option>
                    </select>
                </div>

                <div class="col-xs-12">
                    <label for="costing_method">Inventory Costing Method</label>
                    <select @change="updateSettings()" v-model="settings.costing_method" id="costing_method" class="form-control">
                        <option value="Latest Cost">Latest Cost</option>
                        <option value="Average Cost">Average Cost</option>
                        <option value="Manual Cost Entry">Manual Costing</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-8">
                    Enable Loyalty
                </div>
                <div class="col-xs-4">
                    <input @change="updateSettings('enable_loyalty')" v-model="settings.enable_loyalty" id="enable_loyalty" type="checkbox" class="ios-switch clean ios-switch-success ios-switch-sm" />
                </div>
            </div>

            <div class="row">
                <div class="col-xs-8">
                    Enable Gift Cards
                </div>
                <div class="col-xs-4">
                    <input @change="updateSettings('enable_gift_cards')" v-model="settings.enable_gift_cards" id="enable_gift_cards" type="checkbox" class="ios-switch clean ios-switch-success ios-switch-sm" />
                </div>
            </div>

            <div class="row">
                <div class="col-xs-8">
                    Enable Bundles
                </div>
                <div class="col-xs-4">
                    <input @change="updateSettings('enable_bundles')" v-model="settings.enable_bundles" id="enable_bundles" type="checkbox" class="ios-switch clean ios-switch-success ios-switch-sm"/>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-8">
                    Enable Happy Hour Sales
                </div>
                <div class="col-xs-4">
                    <input @change="updateSettings('enable_happy_hour_sales')" v-model="settings.enable_happy_hour_sales" id="enable_happy_hour_sales" type="checkbox" class="ios-switch clean ios-switch-success ios-switch-sm"/>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <transition name="custom-classes-transition" enter-active-class="animated fadeIn" leave-active-class="animated fadeOut">
                        <div class="alert alert-success" v-show="showInfo">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>Settings Saved</strong>
                        </div>
                    </transition>
                </div>
            </div>
        </div>
</template>

<script>
    export default {
        data() {
            return {
                settings: {
                    inventory_control_method: 'None',
                    costing_method: 'Manual Cost Entry',
                    enable_loyalty: true,
                    enable_gift_cards: true,
                    enable_bundles: true,
                    enable_happy_hour_sales: true,
                },
                showInfo: false
            };
        },
        created() {
            this.$root.isLoading = true;

            axios.get('/setting').then(response => {
                this.settings.enable_loyalty = parseInt(response.data.settings.enable_loyalty) !== 0;
                this.settings.enable_gift_cards = parseInt(response.data.settings.enable_gift_cards) !== 0;
                this.settings.enable_bundles = parseInt(response.data.settings.enable_bundles) !== 0;
                this.settings.enable_happy_hour_sales = parseInt(response.data.settings.enable_happy_hour_sales) !== 0;
                this.settings.inventory_control_method = response.data.settings.inventory_control_method;
                this.settings.costing_method = response.data.settings.costing_method;
                this.setupUI();
                this.$root.isLoading = false;
            }).catch(() => {this.$root.isLoading = false;});
        },

        methods: {
            updateSettings(element = null) {
                this.$root.isLoading = true;

                if (element) this.settings[element] = ! this.settings[element];

                axios.post('/setting', this.settings).then(() => {
                    this.$root.isLoading = false;
                    this.showInfo = true;
                    setTimeout(() => this.showInfo = false, 2000);
                }).catch(() => { this.$root.isLoading = false });
            },

            setupUI() {
                setTimeout(() => {
                    $(".ios-switch.clean").toArray().forEach((elem) => {
                        new Switch(elem);
                    });
                }, 1000);
            }
        }
    }
</script>