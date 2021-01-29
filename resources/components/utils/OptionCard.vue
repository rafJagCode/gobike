<template>
    <v-card 
    @click="goTo(option.link)"
    @mouseover="hover = true"
    @mouseleave="hover = false"
    :class="{'option-card--hover': hover}"
    width="300" :color="hover ?  'secondaryOrange' : 'mainOrange'" class="option-card text-center black--text">
        <v-card-subtitle class="text-center pb-0">
            <v-icon size="80px">{{option.icon}}</v-icon>
        </v-card-subtitle>
        <v-card-subtitle class="text-h5">
            {{option.name}}
        </v-card-subtitle>
    </v-card>
</template>
<script>
export default {
    data(){
        return{
            hover: false
        }
    },
    props: {
        option: null
    },
    methods:{
        goTo(link){
            this.$router.push({name: link});
        }
    }
}
</script>
<style scoped>
    .option-card{
        cursor: pointer;
    }
    .option-card--hover{
        background-color: grey;
    }
</style>