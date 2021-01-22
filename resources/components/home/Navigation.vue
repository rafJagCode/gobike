<template>
  <div>
    <v-navigation-drawer
      v-model="drawer"
      app
      temporary
      dark
      :src="require('@/assets/img/bgDrawer.jpg')"
    >
      <v-list>
        <v-list-item>
          <v-list-item-content>
            <v-list-item-title class="title">GoBike</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
      <v-divider />

      <v-list dense>
          <v-list-item @click.prevent="goToRegister()">
            <v-list-item-icon class="justify-center">
              <v-icon>mdi-account-outline</v-icon>
            </v-list-item-icon>
            <v-list-item-content>
              <v-list-item-title class="subtitile-1">
                Zarejestruj
              </v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        <v-list-item
          v-for="(item, index) in items"
          :key="index"

          @click="$vuetify.goTo(item.link)"
        >
          <v-list-item-icon class="justify-center">
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title class="subtitile-1">{{
              item.name
            }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar
      color='#32373B'
      :flat="flat"
      dark
      class="px-15"
      :class="{ expand: flat }"
    >
      <v-toolbar-title>
        <div class="title text-h4">GoBike</div>
      </v-toolbar-title>
      <v-spacer />
      <v-app-bar-nav-icon
        @click.stop="drawer = !drawer"
        class="mr-4"
        v-if="isXs"
      />
      <div v-else>
        <v-btn color="#FFB300" v-for="(item, index) in items" :key="index" text @click="goTo(item.link)">
          <v-icon left>{{item.icon}}</v-icon>
          <span class="mr-2">{{item.name}}</span>
        </v-btn>
        <router-link v-if="isHome" to="/register" style="text-decoration: none; color: inherit;">
          <v-btn dark color="#FFB300">
            <v-icon left>mdi-account-outline</v-icon>
            Zarejestruj
          </v-btn>
        </router-link>
        <div class="d-inline-flex green--text mx-3" v-if="this.$store.getters.user">Zalogowano {{this.$store.getters.user.email}}</div>
        <v-btn v-if="!isHome" @click="logout()" dark color="#FFB300">
            <v-icon left>mdi-location-exit</v-icon>
            Wyloguj
        </v-btn>
        <!-- <v-btn text @click="$vuetify.goTo('#features')">
          <span class="mr-2">Get Started</span>
        </v-btn>
        <v-btn text @click="$vuetify.goTo('#about')">
          <span class="mr-2">About</span>
        </v-btn>
        <v-btn text @click="$vuetify.goTo('#contact')">
          <span class="mr-2">Contact Us</span>
        </v-btn>
        <v-btn text>
          <span class="mr-2">Login</span>
        </v-btn>
        <v-btn rounded outlined text>
          <span class="mr-2">Sign Up</span>
        </v-btn> -->
      </div>
    </v-app-bar>
  </div>
</template>

<style scoped>
.v-toolbar {
  transition: 0.6s;
}
.title{
  color: #FFB300;
  font-family: 'Exo', sans-serif;
}
.expand {
  height: 80px !important;
  padding-top: 10px;
}
.drawer-logo{
  height:20px;
  width:40px;
  background-size: cover;
}
</style>

<script>
export default {
  data: () => ({
    isHome: true,
    drawer: null,
    isXs: false,
    items: [
      {
        icon:"mdi-information-outline",
        name:"Nasze rowery",
        link:"#about"
      },
      {
        icon:"mdi-bike",
        name:"Wypożycz rower",
        link:"#about"
      },
      {
        icon:"mdi-login-variant",
        name:"Zaloguj",
        link:"login"
      },
    ],
  }),
  props: {
    color: String,
    flat: Boolean,
  },
  methods: {
    onResize() {
      this.isXs = window.innerWidth < 960;
    },
    goToRegister(){
      this.$router.push({name: 'register'});
    },
    goTo(link){
      this.$router.push({name: link});
    },
    setItems(){
      if(this.$route.name!=='home'){
        this.isHome = false;
        this.items = [];
      }
    },
    logout(){
      Vue.axios.post('/api/logout').then(()=>{
          this.$store.dispatch('logoutUser');
          this.$router.push({name: 'home'})
      })
    } 
  },

  watch: {
    isXs(value) {
      if (!value) {
        if (this.drawer) {
          this.drawer = false;
        }
      }
    },
  },
  mounted() {
    this.onResize();
    window.addEventListener("resize", this.onResize, { passive: true });
    this.setItems();
  },
};
</script>
