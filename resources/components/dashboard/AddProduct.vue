<template>
    <v-layout justify-center align-center>
        <v-card color="secondary mainOrange--text" width="800">
            <v-card-title>Dodaj produkt</v-card-title>
            <v-form
                width="500px!important"
                class="ma-6 mainOrange--text"
                ref="form"
                v-model="valid"
                lazy-validation
            >
            
                <v-text-field
                dark
                v-model="name"
                :rules='nameRules'
                label="Nazwa"
                color="mainOrange"
                validate-on-blur
                ></v-text-field>
                <v-text-field
                dark
                v-model="price"
                :rules="priceRules"
                label="Cena"
                color="mainOrange"
                validate-on-blur
                ></v-text-field>
                <v-text-field
                dark
                v-model="description"
                :rules="descriptionRules"
                label="Opis"
                color="mainOrange"
                validate-on-blur
                ></v-text-field>
                <v-text-field
                dark
                v-model="img"
                :rules="imgRules"
                label="Zdjęcie"
                color="mainOrange"
                validate-on-blur
                ></v-text-field>
                <v-btn 
                class="signup-btn mainOrange--text mt-8"
                type="submit"
                outlined
                rounded
                block
                @click.prevent="handleSubmit()"
                >Dodaj</v-btn>
            </v-form>
            <v-dialog width="200" v-model="addedSuccessful">
                <v-card color="secondary" class="pa-2">
                    <v-layout column justify-center align-center>
                        <v-card-text class="mainOrange--text text-h5 text-center">Produkt dodany pomyślnie</v-card-text>
                        <v-layout>
                            <v-btn color="success" @click="addedSuccessful = false">OK</v-btn>
                        </v-layout>
                    </v-layout>
                </v-card>
            </v-dialog>
        </v-card>
    </v-layout>
</template>
<script>
export default {
    data(){
        return{
            valid: true,
            name: '',
            price: '',
            img: '',
            description: '',
            nameRules:[
                v => !!v || 'Musisz wpisać nazwę',
            ],
            priceRules:[
                v => !!v || 'Musisz wpisać cenę',
                v => /^\d+(\.\d{2})?$/.test(v) || 'Zły format ceny',
            ],
            descriptionRules:[
                v => !!v || 'Musisz wpisać opis',
            ],
            imgRules:[
                v => !!v || 'Musisz podać nazwę zdjęcia',
            ],
            addedSuccessful: false,
        }
    },
    methods:{
        handleSubmit(){
            if(!this.$refs.form.validate()) return;
            Vue.axios.post('/api/addproduct',
            {
                'name': this.name, 
                'price': parseFloat(this.price), 
                'availability': true,
                'description': this.description,
                'img': this.img

            })
            .then(()=>{
                this.addedSuccessful = true;
            });
        }
    },
}
</script>