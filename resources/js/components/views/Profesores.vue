<template>
    <div>
        <nav-bar></nav-bar>

        <v-card>
            <v-card-title>
                Profesores
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
                :items="profesores"
                :items-per-page="15"
                item-key="id"
                class="elevation-1"
                :search="search"
            ></v-data-table>
        </v-card>
    </div>
</template>

<script>
import NavBar from "../NavBar.vue";
export default {
    components: { NavBar },
    name: "profesores",
    data() {
        return {
            search: "",
            profesores: [],
            headers: [
                { text: "Id", value: "id" },
                { text: "Nombre", value: "name" },
                { text: "Apellido", value: "surname" },
                { text: "الإسم", value: "name_ar" },
                { text: "اللقب", value: "surname_ar" },
                { text: "Telefono", value: "telefono" },
            ]
        };
    },
    methods: {
        getPadres() {
            axios.get("api/profesores").then(response => {
                this.profesores = response.data.data;
            });
        }
    },
    created() {
        this.getPadres();
    }
};
</script>

<style scoped></style>
