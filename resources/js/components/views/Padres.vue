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

                    <v-icon small @click="goToFile(item)">
                        mdi-eye
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
                    <span class="text-h5"> Editar datos Padre/Madre </span>
                </v-card-title>

                <v-card-text>
                    <v-container>
                        <v-row>
                            <v-col cols="12" md="6">
                                <v-text-field
                                    id="name"
                                    name="name"
                                    placeholder="Nombre"
                                    label="Nombre Padre/Madre"
                                    v-model="editedItem.name"
                                ></v-text-field>
                            </v-col>

                            <v-col cols="12" md="6">
                                <v-text-field
                                    id="apellido"
                                    name="apellido"
                                    placeholder="Apellido"
                                    label="Apellido Padre/Madre"
                                    v-model="editedItem.surname"
                                ></v-text-field>
                            </v-col>
                        </v-row>

                        <v-row>
                            <v-col cols="12" md="6">
                                <v-text-field
                                    id="name_ar"
                                    name="name_ar"
                                    placeholder="اسم"
                                    label="اسم الأب"
                                    v-model="editedItem.name_ar"
                                ></v-text-field>
                            </v-col>

                            <v-col cols="12" md="6">
                                <v-text-field
                                    id="apellido_ar"
                                    name="apellido_ar"
                                    placeholder="لقب"
                                    label="لقب الأب"
                                    v-model="editedItem.surname_ar"
                                ></v-text-field>
                            </v-col>
                        </v-row>

                        <v-row>
                            <v-col cols="12" md="4">
                                <v-text-field
                                    id="email"
                                    name="email"
                                    placeholder="Correo"
                                    label="E-mail"
                                    v-model="editedItem.email"
                                ></v-text-field>
                            </v-col>

                            <v-col cols="12" md="4">
                                <v-text-field
                                    id="dni"
                                    name="dni"
                                    placeholder="DNI"
                                    label="DNI"
                                    v-model="editedItem.dni"
                                ></v-text-field>
                            </v-col>

                            <v-col cols="12" md="4">
                                <v-text-field
                                    id="phone"
                                    name="telefono"
                                    placeholder="Telefono"
                                    label="Telefono"
                                    v-model="editedItem.telefono"
                                ></v-text-field>
                            </v-col>
                        </v-row>

                        <v-row>
                            <v-col cols="12" md="12">
                                <v-text-field
                                    id="address"
                                    name="address"
                                    placeholder="address"
                                    label="address"
                                    v-model="editedItem.address"
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
    name: "padres",
    data() {
        return {
            dialog: false,
            dialogDelete: false,
            search: "",
            padres: [],
            editedIndex: -1,
            editedItem: {},
            headers: [
                { text: "Id", value: "id" },
                { text: "Nombre", value: "name" },
                { text: "Apellido", value: "surname" },
                { text: "الإسم", value: "name_ar" },
                { text: "اللقب", value: "surname_ar" },
                { text: "Telefono", value: "telefono" },
                { text: "E-mail", value: "email" },
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
            this.editedIndex = this.padres.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },
        deleteItem(item) {
            this.editedIndex = this.padres.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialogDelete = true;
        },
        goToFile(item) {
            this.$router.push("/padre/" + item.id);
        },
        deleteItemConfirm() {
            axios
                .delete("api/padres/" + this.editedItem.id)
                .then(response => {
                    if (response.status === 200) {
                        this.getPadres();
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
                .put("api/padres/" + this.editedItem.id, this.editedItem)
                .then(response => {
                    if (response.status === 200) {
                        this.getPadres();
                    }
                })
                .catch(error => {
                    console.log(this.$data);
                })
                .finally(() => {
                    //Perform action in always
                });
        }
        // }
    },
    created() {
        this.getPadres();
    }
};
</script>

<style scoped></style>
