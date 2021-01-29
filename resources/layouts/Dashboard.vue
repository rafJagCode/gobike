<template>
  <v-app>
    <navigation color="secondary" :flat="true" />
    <v-main class="dashboard__main pt-0">
        <v-container fill-height class="dashboard__menu">
            <router-view :key="$route.fullPath"></router-view>
        </v-container>
    </v-main>
    <vfooter />
  </v-app>
</template>
<script>
import navigation from "@/components/home/Navigation";
import vfooter from "@/components/home/Footer";


export default {
    data: () => ({
        user: null
    }),
    mounted(){
        Vue.axios.get('/api/user', {withCredentials: true}).then((res)=>{
            this.$store.dispatch('setUser', res.data);
            this.user = res.data;
        }).catch((error)=>{
            this.$router.push({name:'home'});
        })
    },
    methods:{
        logout(){
            Vue.axios.post('/api/logout').then(()=>{
                this.$store.dispatch('logoutUser');
                this.$router.push({name: 'home'})
            })
        }
    },
    components: {
        navigation,
        vfooter,
  },
}
</script>
<style scoped>
    .dashboard__main{
        background-image: url("~@/assets/img/cyclistBg2.jpg");
        background-repeat: no-repeat;
        background-size: cover;
    }
</style>