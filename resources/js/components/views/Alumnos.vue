<template>
    <div>
        <nav-bar></nav-bar>
        <v-card>
            <v-card-title>
                Alumnos
                <v-spacer></v-spacer>
                <v-text-field
                    v-model="search"
                    append-icon="mdi-magnify"
                    label="Search"
                    single-line
                    hide-details
                ></v-text-field>
            </v-card-title>

            <v-data-table
                dense
                :headers="headers"
                :items="alumnos"
                item-key="id"
                class="elevation-1t"
                :search="search"
            ></v-data-table>
        </v-card>
    </div>
</template>

<script>
import NavBar from "../NavBar.vue";
export default {
    components: { NavBar },
    name: "alumnos",
    data() {
        return {
            search: "",
            alumnos: [],
            headers: [
                { text: "Id", value: "id" },
                { text: "Nombre", value: "name" },
                { text: "Apellido", value: "surname" },
                { text: "الإسم", value: "surname_ar" },
                { text: "اللقب", value: "name_ar" }
            ]
        };
    },
    methods: {
        getAlumnos() {
            axios.get("api/alumnos").then(response => {
                this.alumnos = response.data.data;
            });
        }
    },
    created() {
        this.getAlumnos();
    }
};
</script>

<style scoped></style>
