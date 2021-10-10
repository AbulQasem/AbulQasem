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

        <v-dialog v-model="dialog" max-width="800px">
            <v-card>
                <v-card-title>
                    <span class="text-h5"> Editar pago </span>
                </v-card-title>

                <v-card-text>
                    <v-container>
                        <v-row>
                            <v-col cols="12" md="6">
                                <v-text-field
                                    id="name"
                                    name="name"
                                    placeholder="Nombre"
                                    label="Cantidad"
                                    v-model="editedItem.cantidad"
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

        <v-dialog v-model="dialogDelete" max-width="500px">
            <v-card>
                <v-card-title class="text-h5"
                    >Are you sure you want to delete this item?</v-card-title
                >
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text @click="closeDelete"
                        >Cancel</v-btn
                    >
                    <v-btn color="blue darken-1" text @click="deleteItemConfirm"
                        >OK</v-btn
                    >
                    <v-spacer></v-spacer>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
import NavBar from "../NavBar.vue";
export default {
    components: { NavBar },
    name: "pagos",
    data() {
        return {
            dialog: false,
            dialogDelete: false,
            search: "",
            pagos: [],
            editedIndex: -1,
            editedItem: {},
            headers: [
                { text: "Id", value: "id" },
                { text: "Nombre", value: "name" },
                { text: "Apellid", value: "surname" },
                { text: "Cantidad", value: "cantidad" },
                { text: "Fecha", value: "created_at" },
                { text: "Actions", value: "actions", sortable: false }
            ]
        };
    },
    methods: {
        getPagos() {
            axios.get("api/pagos").then(response => {
                this.pagos = response.data.data;
            });
        },
        editItem(item) {
            this.editedIndex = this.pagos.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },
        deleteItem(item) {
            this.editedIndex = this.pagos.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialogDelete = true;
        },
        deleteItemConfirm() {
            axios
                .delete("api/pagos/" + this.editedItem.id)
                .then(response => {
                    if (response.status === 200) {
                        this.getPagos();
                    }
                })
                .catch(error => {
                    console.log("ERROR");
                })
                .finally(() => {
                    //Perform action in always
                });
            this.closeDelete();
        },
        close() {
            this.dialog = false;
        },
        closeDelete() {
            this.dialogDelete = false;
        },
        save() {
            this.submitForm();
            this.close();
        },
        submitForm() {
            // this.$v.$touch();

            // if (this.$v.$invalid) {
            //     this.$v.$touch();
            // } else {
            console.log(this.editedItem);
            console.log("api/padres/" + this.editedItem.id);
            axios
                .put("api/pagos/" + this.editedItem.id, this.editedItem)
                .then(response => {
                    if (response.status === 200) {
                        this.getPagos();
                    }
                })
                .catch(error => {
                    console.log(this.$data);
                })
                .finally(() => {
                    //Perform action in always
                });
        }
    },
    created() {
        this.getPagos();
    }
};
</script>

<style scoped></style>
