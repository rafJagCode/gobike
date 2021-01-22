<template>
    <v-container fluid fill-height class="register">
      <v-layout row wrap align-center> 
        <v-flex xs12 sm6 offset-sm3>
          <v-card 
          elevation="5"
          outlined
          color="#32373B"
          >
            <v-container class="register__label mainOrange">
              <v-row align="center">
                <router-link to="/" style="text-decoration: none; color: inherit;">
                  <v-btn class="black--text home-btn ml-4" outlined color="black">
                    <v-icon>mdi-home-outline</v-icon>
                  </v-btn>
                </router-link>
                <v-spacer></v-spacer>
                <div class="register__logo">GoBike</div>
              </v-row>
            </v-container>
            <v-form
              class="ma-6"
              ref="form"
              v-model="valid"
              lazy-validation
            >
          
              <v-text-field
                v-model="email"
                :rules="emailRules"
                label="E-mail"
                validate-on-blur
                color="mainOrange"
                dark
              ></v-text-field>
              <v-text-field
                v-model="password"
                type="password"
                :rules="passwordRules"
                label="Hasło"
                validate-on-blur
                color="mainOrange"
                dark
              ></v-text-field>
              <v-btn 
              class="signup-btn secondary--text mt-8"
              type="submit"
              outlined
              rounded
              block
              @click.prevent="handleSubmit()"
              >Zaloguj</v-btn>
          
            </v-form>
          </v-card>
          <v-card class="mt-2 pa-6" color="#32373B">
            <v-row align="center" justify="center">
              <div class="sign-up-text">
                Nie masz jeszcze konta?
                <v-icon color="mainOrange">mdi-arrow-right</v-icon>
                <router-link to="/register" style="text-decoration: none; color: inherit;">
                  <v-btn color='#FFB300'>
                    <strong>Zarejestruj się</strong>
                  </v-btn>
                </router-link>
              </div>
            </v-row>
          </v-card>
        </v-flex>
      </v-layout>
    </v-container>
</template>
<script>
export default {
  data: () => ({
    valid: true,
    email: '',
    password: "",
    emailRules:[
      v => !!v || 'E-mail is required',
      v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
    ],
    passwordRules: [
        v => !!v || 'Password is required',
      ],
  }),

  methods: {
    handleSubmit(){
      if(!this.$refs.form.validate()) return;
      Vue.axios.post('api/login', {email:this.email, password:this.password}).then((res)=>{
        this.$router.push({ name: 'dashboard'});
      }).catch((error)=>{
        this.errors = error.response.data.errors;
      });
    }
  }
}
</script>
<style scoped>
.register{
    background-image: url("~@/assets/img/cyclistBg.jpg");
    background-repeat: no-repeat;
    background-size: cover;
}
.register__label{
  height:80px;
}
.register__logo{
  font-size:20px;
  color: #32373B;
  font-family: 'Exo', sans-serif;
  margin-right: 20px;
}
.home-btn:hover{
  color:#FFB300!important;
  background-color: #32373B;
  transition: 0.3s;
}
.signup-btn{
  color:#32373B;
  background-color: #ffb3008e;
  transition: 0.3s;
}
.signup-btn:hover{
  color: black!important;
  background-color: #FFB300;
  transition: 0.3s;
}
.sign-up-text{
  color:#FFB300;
}
</style>