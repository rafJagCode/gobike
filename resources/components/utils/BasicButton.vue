<template>
    <v-btn :block="this.block" @click="goTo()"  color="#FFB300">
        <v-icon left>{{this.icon}}</v-icon>
        {{this.text}}
    </v-btn>
</template>
<script>
export default {
    props:{
        text: '',
        icon: '',
        routeName: '',
        block: true,
    },
    methods:{
        goTo(){
            this.$router.push({name: this.routeName});
        }
    }
}
</script>