<template>
    <v-form
        class="ma-6"
        ref="form"
        v-model="valid"
        lazy-validation
    >
    
        <v-text-field
        v-model="name"
        :rules='nameRules'
        label="Nazwa"
        color="mainOrange"
        validate-on-blur
        ></v-text-field>
        <v-text-field
        v-model="price"
        :rules="priceRules"
        label="Cena"
        color="mainOrange"
        validate-on-blur
        ></v-text-field>
        <v-text-field
        v-model="description"
        :rules="descriptionRules"
        label="Opis"
        color="mainOrange"
        validate-on-blur
        ></v-text-field>
        <v-text-field
        v-model="img"
        :rules="imgRules"
        label="Zdjęcie"
        color="mainOrange"
        validate-on-blur
        ></v-text-field>
        <v-btn 
        class="signup-btn secondary--text mt-8"
        type="submit"
        outlined
        rounded
        block
        @click.prevent="handleSubmit()"
        >Dodaj</v-btn>
    
    </v-form>
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
            ]
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

                });
        }
    },
}
</script>