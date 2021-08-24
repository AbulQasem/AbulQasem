<template>
    <div>
        <nav-bar></nav-bar>

        <v-card>
            <v-card-title>
                Padres
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
                :items="pagos"
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
    name: "pagos",
    data() {
        return {
            search: "",
            pagos: [],
            headers: [
                { text: "Id", value: "id" },
                { text: "Padre", value: "padres_id" },
                { text: "Cantidad", value: "cantidad" },
                { text: "Fecha", value: "created_at" }
            ]
        };
    },
    methods: {
        getPagos() {
            axios.get("api/pagos").then(response => {
                this.pagos = response.data.data;
            });
        }
    },
    created() {
        this.getPagos();
    }
};
</script>

<style scoped></style>
