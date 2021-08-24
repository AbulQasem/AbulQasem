<template>
    <div>
        <nav-bar></nav-bar>
        <v-card>
            <v-card-title>
                Grupos
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
                :items="grupos"
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
    name: "grupos",
    components: { NavBar },
    data() {
        return {
            search: "",
            grupos: [],
            headers: [
                { text: "Id", value: "id" },
                { text: "Dia", value: "dia" },
                { text: "Horario", value: "horario" },
                { text: "Aula", value: "aula" },
                { text: "Nivel", value: "nivel" },
                { text: "Profesor", value: "profesor_id" }
            ]
        };
    },
    methods: {
        getGrupos() {
            axios.get("api/grupos").then(response => {
                this.grupos = response.data.data;
            });
        }
    },
    created() {
        this.getGrupos();
    }
};
</script>

<style scoped></style>
