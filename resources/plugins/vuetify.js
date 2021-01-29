import Vue from 'vue';
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
import '@mdi/font/css/materialdesignicons.css';

Vue.use(Vuetify)



export default new Vuetify({
    theme: {
        themes: {
            light: {
                primary: "07506e",
                primaryLight: "52C6F4",
                secondary: "32373B",
                secondaryLight: "252C55",
                accent: "3D87E4",
                mainOrange: "FFB300",
                secondaryOrange: "F17105",
                mainRed: "FF0F00"
            }
        }
    }
});