<template>
  <v-app>
    <navigation color="secondary" :flat="true" />
    <v-main class="dashboard__main pt-0">
        <v-container class="dashboard__menu">
            <v-row>
                <v-col cols=12 md=6 v-for="(option,index) in options" :key="index" class="d-flex justify-center">
                    <v-card width="300" color="mainOrange" class="text-center">
                        <v-card-subtitle class="text-center">
                            <v-icon size="50px">{{option.icon}}</v-icon>
                        </v-card-subtitle>
                        {{option.name}}
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </v-main>
    <vfooter />
  </v-app>
</template>

    <!-- <div class="dashboard">
        Dashboard <br>
        Email: {{user.email}}<br><br>
        <v-btn @click.prevent="logout()">Logout</v-btn>
        </div> -->

<script>
import navigation from "@/components/home/Navigation";
import vfooter from "@/components/home/Footer";
export default {
    data: () => ({
        user: null,
        options: [
            {
                name: "Wypożycz rower",
                icon: "mdi-bike"
            },
            {
                name: "Wypożycz akcesoria",
                icon: "mdi-bike"
            },
            {
                name: "Przeglądaj rezerwacje",
                icon: "mdi-bike"
            },
            {
                name: "Ustawienia konta",
                icon: "mdi-bike"
            }
        ]
    }),
    mounted(){
        Vue.axios.get('/api/user', {withCredentials: true}).then((res)=>{
            this.$store.dispatch('setUser', res.data);
            this.user = res.data;
        }).catch((error)=>{
            console.log(error);
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
        vfooter
  },
}
</script>
<style scoped>
    .dashboard__main{
        background-image: url("~@/assets/img/cyclistBg2.jpg");
        background-repeat: no-repeat;
        background-size: cover;
    }
    .dashboard__menu{
        width:700px;
    }
</style>