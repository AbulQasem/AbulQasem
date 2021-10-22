<template>
    <div>
        <nav-bar></nav-bar>

        <v-card class="mx-auto mt-10" max-width="92%">
            <v-toolbar flat color="primary" dark>
                <v-toolbar-title>Ficha Profesor</v-toolbar-title>
            </v-toolbar>
        </v-card>
    </div>
</template>

<script>
import NavBar from "./NavBar.vue";

export default {
    name: "profesor",
    components: { NavBar },
    data() {
        return {
            dialog: false,
            tab: null,
            profesor: {},
            grupos: []
        };
    },
    methods: {
        getProfesor() {
            axios
                .get("/api/profesores/" + this.$route.params.id)
                .then(response => {
                    this.profesor = response.data.profesor;
                });
        }
    },
    created() {
        this.getProfesor();
    }
};
</script>

<style>
.whatsapp-button {
    margin: 2px;
    padding: 2px;
}

.buttons {
    padding: auto;
    margin: 10px;
}
</style>
