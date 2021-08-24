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
                :items="padres"
                :items-per-page="15"
                item-key="id"
                class="elevation-1"
                :search="search"
                @row-click="handleFunction"
            >
                <template v-slot:item.actions="{ item }">
                    <v-icon small class="mr-2" @click="editItem(item)">
                        mdi-pencil
                    </v-icon>
                    <v-icon small @click="deleteItem(item)">
                        mdi-delete
                    </v-icon>
                </template>
            </v-data-table>
        </v-card>

        <v-dialog v-model="dialog" max-width="500px">
            <v-card>
                <v-card-title>
                    <span class="text-h5"> Editar datos padre </span>
                </v-card-title>

                <v-card-text>
                    <v-container>
                        <v-row>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field
                                    label="Dessert name"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field label="Calories"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field label="Fat (g)"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field label="Carbs (g)"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field
                                    label="Protein (g)"
                                ></v-text-field>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text @click="close">
                        Cancel
                    </v-btn>
                    <v-btn color="blue darken-1" text @click="save">
                        Save
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
import NavBar from "../NavBar.vue";
export default {
    components: { NavBar },
    name: "padres",
    data() {
        return {
            dialog: false,
            search: "",
            padres: [],
            headers: [
                { text: "Id", value: "id" },
                { text: "Nombre", value: "name" },
                { text: "Apellido", value: "surname" },
                { text: "الإسم", value: "name_ar" },
                { text: "اللقب", value: "surname_ar" },
                { text: "Telefono", value: "telefono" },
                { text: "Matricula", value: "Matricula" },
                { text: "Actions", value: "actions", sortable: false }
            ]
        };
    },
    methods: {
        getPadres() {
            axios.get("api/padres").then(response => {
                this.padres = response.data.data;
            });
        },
        handleFunction() {
            console.log("HOLA");
        },
        editItem(item) {
            //this.editedIndex = this.desserts.indexOf(item);
            // this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },
        deleteItem(item) {
            //this.editedIndex = this.desserts.indexOf(item);
            //this.editedItem = Object.assign({}, item);
            this.dialogDelete = true;
        },
        deleteItemConfirm() {
            //this.desserts.splice(this.editedIndex, 1);
            this.closeDelete();
        },
        close() {
            this.dialog = false;
        },
        closeDelete() {
            this.dialogDelete = false;
        },
        save() {
            this.close();
        }
    },
    created() {
        this.getPadres();
    }
};
</script>

<style scoped></style>
