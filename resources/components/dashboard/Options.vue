<template>
    <v-container style="width:700px">
        <v-row >
            <v-col cols=12 md=6 v-for="(option,index) in options" :key="index" class="d-flex justify-center">
                <option-card :option="option"></option-card>
            </v-col>
        </v-row>
    </v-container>
</template>
<script>
import optionCard from "@/components/utils/OptionCard";
export default {
    data(){
        return{
            options: [
                {
                    name: "Wypożycz rower",
                    icon: "mdi-bike",
                    link: "products"
                },
                {
                    name: "Wypożycz akcesoria",
                    icon: "mdi-plus-circle"
                },
                {
                    name: "Przeglądaj rezerwacje",
                    icon: "mdi-calendar",
                    link: "reservations"
                },
                {
                    name: "Ustawienia konta",
                    icon: "mdi-wrench"
                }
            ]
        }
    },
    components:{
        optionCard
    }
}
</script>