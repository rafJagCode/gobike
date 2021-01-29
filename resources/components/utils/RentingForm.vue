<template>
    <v-form class="ma-3">
        <v-menu
            ref="menu"
            v-model="menu"
            :close-on-content-click="false"
            :return-value.sync="dateFrom"
            transition="scale-transition"
            offset-y
            min-width="auto"
            >
            <template v-slot:activator="{ on, attrs }">
                <v-text-field
                v-model="dateFrom"
                label="Data odebrania roweru:"
                prepend-icon="mdi-calendar"
                v-bind="attrs"
                v-on="on"
                ></v-text-field>
            </template>
            <v-date-picker
                v-model="dateFrom"
                no-title
                scrollable
                locale="pl"
                :show-current="false"
            >
                <v-spacer></v-spacer>
                <v-btn
                text
                color="primary"
                @click="menu = false"
                >
                Cancel
                </v-btn>
                <v-btn
                text
                color="primary"
                @click="$refs.menu.save(dateFrom)"
                >
                OK
                </v-btn>
            </v-date-picker>
            </v-menu>
            <v-menu
            ref="menu2"
            v-model="menu2"
            :close-on-content-click="false"
            :return-value.sync="dateTo"
            transition="scale-transition"
            offset-y
            min-width="auto"
            >
            <template v-slot:activator="{ on, attrs }">
                <v-text-field
                v-model="dateTo"
                label="Data zwrotu roweru:"
                prepend-icon="mdi-calendar"
                v-bind="attrs"
                v-on="on"
                ></v-text-field>
            </template>
            <v-date-picker
                v-model="dateTo"
                no-title
                scrollable
                locale="pl"
                :show-current="false"
            >
                <v-spacer></v-spacer>
                <v-btn
                text
                color="primary"
                @click="menu2 = false"
                >
                Cancel
                </v-btn>
                <v-btn
                text
                color="primary"
                @click="$refs.menu2.save(dateTo)"
                >
                OK
                </v-btn>
            </v-date-picker>
        </v-menu>
        <v-alert width="200" v-if="showAlert" color="secondary" class="py-0 my-0 mainRed--text">{{alertMessage}}</v-alert>
        <v-btn 
        class="signup-btn mainOrange--text mt-1"
        type="submit"
        outlined
        rounded
        block
        dark
        @click.prevent="handleSubmit()">
            WYPOŻYCZ
        </v-btn>
    </v-form>
</template>
<script>
export default {
    data: () => ({
        dateFrom: new Date().toISOString().substr(0, 10),
        dateTo: new Date(Date.now()+1000*60*60*24).toISOString().substr(0, 10),
        menu: false,
        menu2: false,
        modal: false,
        showAlert: false,
        alertMessage: ''
    }),
    props:{
        productId: null
    },
    methods:{
        handleSubmit(){
            if(!this.isDateFromCorrect()){
                this.alertMessage = 'Data odebrania nie może być wcześniejsza niż dzisiejsza';
                this.showAlert = true;
                return;
            }
            else if(!this.isPeriodCorrect()) {
                this.alertMessage = 'Data zwrotu musi być datą późniejszą niż data odebrania';
                this.showAlert = true;
                return;
            }
            else{
                Vue.axios.post('/api/makeReservation',
                {
                    'dateFrom':this.dateFrom,
                    'dateTo':this.dateTo,
                    'status':1,
                    'userId':this.$store.getters.user.id,
                    'productId':this.productId,
                });
            };
        },
        isPeriodCorrect(){
            let dateFrom = new Date(this.dateFrom);
            let dateTo = new Date(this.dateTo);
            if(dateFrom.getTime()>=dateTo.getTime()) return false;
            return true;
        },
        isDateFromCorrect(){
            let dateFrom = new Date(this.dateFrom);
            let now = new Date(new Date().toISOString().substr(0, 10));
            if(dateFrom.getTime()<now.getTime()) return false;
            return true;
        }
    },
}
</script>