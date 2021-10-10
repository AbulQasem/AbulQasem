<template>
    <div>
        <nav-bar></nav-bar>

        <v-card class="mx-auto mt-10" max-width="90%">
            <v-toolbar flat color="primary" dark>
                <v-toolbar-title>Ficha Padre</v-toolbar-title>
            </v-toolbar>
            <v-tabs vertical>
                <v-tab>
                    <v-icon left>
                        mdi-account
                    </v-icon>
                    Datos padre
                </v-tab>
                <v-tab>
                    <v-icon left> </v-icon>
                    Datos hijos
                </v-tab>
                <v-tab>
                    <v-icon left> </v-icon>
                    Pagos realizados
                </v-tab>

                <v-tab-item>
                    <v-card flat>
                        <v-card-text>
                            <v-list>
                                <!-- NOMBRE Y APELLIDO -->
                                <v-list-item>
                                    <v-list-item-icon>
                                        <v-icon color="indigo">
                                            mdi-account
                                        </v-icon>
                                    </v-list-item-icon>

                                    <v-list-item-content>
                                        <v-list-item-title>
                                            Nombre
                                        </v-list-item-title>
                                        <v-list-item-subtitle>{{
                                            padre.name + " " + padre.surname
                                        }}</v-list-item-subtitle>
                                    </v-list-item-content>
                                </v-list-item>

                                <!-- Phone -->
                                <v-list-item>
                                    <v-list-item-icon>
                                        <v-icon color="indigo">
                                            mdi-phone
                                        </v-icon>
                                    </v-list-item-icon>

                                    <v-list-item-content>
                                        <v-list-item-title>
                                            Teléfono
                                        </v-list-item-title>
                                        <v-list-item-subtitle>{{
                                            padre.telefono
                                        }}</v-list-item-subtitle>
                                    </v-list-item-content>
                                </v-list-item>

                                <!-- DNI-->
                                <v-list-item>
                                    <v-list-item-icon>
                                        <v-icon color="indigo">
                                            mdi-card
                                        </v-icon>
                                    </v-list-item-icon>

                                    <v-list-item-content>
                                        <v-list-item-title>
                                            DNI
                                        </v-list-item-title>
                                        <v-list-item-subtitle>{{
                                            padre.dni
                                        }}</v-list-item-subtitle>
                                    </v-list-item-content>
                                </v-list-item>

                                <!-- Mail-->
                                <v-list-item>
                                    <v-list-item-icon>
                                        <v-icon color="indigo">
                                            mdi-mail
                                        </v-icon>
                                    </v-list-item-icon>

                                    <v-list-item-content>
                                        <v-list-item-title>
                                            Correo
                                        </v-list-item-title>
                                        <v-list-item-subtitle>{{
                                            padre.email
                                        }}</v-list-item-subtitle>
                                    </v-list-item-content>
                                </v-list-item>

                                <!-- Address-->
                                <v-list-item>
                                    <v-list-item-icon>
                                        <v-icon color="indigo">
                                            mdi-map-marker
                                        </v-icon>
                                    </v-list-item-icon>

                                    <v-list-item-content>
                                        <v-list-item-title>
                                            Dirección
                                        </v-list-item-title>
                                        <v-list-item-subtitle>
                                            {{
                                                padre.address +
                                                    ", " +
                                                    padre.postalcode +
                                                    ", " +
                                                    padre.city
                                            }}
                                        </v-list-item-subtitle>
                                    </v-list-item-content>
                                </v-list-item>
                            </v-list>
                        </v-card-text>
                    </v-card>
                </v-tab-item>

                <v-tab-item>
                    <v-card flat>
                        <v-card-text>
                            <v-list
                                v-for="(hijo, index) in hijos"
                                :key="index"
                                three-line
                            >
                                <!-- NOMBRE Y APELLIDO -->
                                <v-list-item>
                                    <v-list-item-icon>
                                        <v-icon color="indigo">
                                            mdi-account
                                        </v-icon>
                                    </v-list-item-icon>

                                    <v-list-item-content>
                                        <v-list-item-title>
                                            Nombre
                                        </v-list-item-title>
                                        <v-list-item-subtitle>{{
                                            hijo.name + " " + hijo.surname
                                        }}</v-list-item-subtitle>
                                    </v-list-item-content>

                                    <v-list-item-content>
                                        <v-list-item-title>
                                            Fecha de nacimiento
                                        </v-list-item-title>
                                        <v-list-item-subtitle>{{
                                            hijo.birthday
                                        }}</v-list-item-subtitle>
                                    </v-list-item-content>

                                    <v-list-item-content>
                                        <v-list-item-title>
                                            Grupo
                                        </v-list-item-title>
                                        <v-list-item-subtitle>{{
                                            hijo.grupos_id
                                        }}</v-list-item-subtitle>
                                    </v-list-item-content>
                                </v-list-item>
                            </v-list>
                        </v-card-text>
                    </v-card>
                </v-tab-item>

                <v-tab-item>
                    <v-card flat>
                        <v-card-text>
                            <v-list v-for="(pago, index) in pagos" :key="index">
                                <!-- PAGO -->
                                <v-list-item>
                                    <v-list-item-icon>
                                        <v-icon color="indigo">
                                            mdi-money
                                        </v-icon>
                                    </v-list-item-icon>

                                    <v-list-item-content>
                                        <v-list-item-title>
                                            {{ "Fecha:   " + pago.created_at }}
                                        </v-list-item-title>
                                        <v-list-item-subtitle>{{
                                            pago.cantidad
                                        }}</v-list-item-subtitle>
                                    </v-list-item-content>
                                </v-list-item>
                            </v-list>
                        </v-card-text>
                    </v-card>
                    <v-container ml-16>
                        <v-spacer></v-spacer>
                        <v-btn
                            color="warning"
                            x-large
                            dark
                            type="submit"
                            @click="newPay()"
                        >
                            Nuevo pago
                        </v-btn>
                        <v-btn
                            color="primary"
                            x-large
                            dark
                            type="submit"
                            @click="print()"
                        >
                            Imprimir
                        </v-btn>
                    </v-container>
                </v-tab-item>
            </v-tabs>
        </v-card>

        <v-dialog v-model="dialog" max-width="500px">
            <v-card>
                <v-card-title class="text-h5"
                    >Registrar nuevo pago</v-card-title
                >
                <v-container>
                    <v-row>
                        <v-col cols="12" md="12">
                            <v-text-field
                                id="cantidad"
                                name="cantidad"
                                placeholder="Cantidad"
                                label="Cantidad"
                                v-model="nuevoPago.cantidad"
                            ></v-text-field>
                        </v-col>
                    </v-row>
                </v-container>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text @click="closeNewPayment"
                        >Cancelar</v-btn
                    >
                    <v-btn color="blue darken-1" text @click="savePay"
                        >Guardar</v-btn
                    >
                    <v-spacer></v-spacer>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
import NavBar from "./NavBar.vue";
import VueHtml2pdf from "vue-html2pdf";

export default {
    name: "padre",
    components: { NavBar, VueHtml2pdf },
    props: ["padre_id"],

    data() {
        return {
            dialog: false,
            tab: null,
            padre: {},
            hijos: [],
            pagos: [],
            nuevoPago: {
                padre_id: "",
                user_id: "",
                cantidad: ""
            }
        };
    },
    methods: {
        getPadre() {
            axios.get("/api/padres/" + this.$route.params.id).then(response => {
                this.padre = response.data.padre;
                this.hijos = response.data.hijos;
                this.pagos = response.data.pagos;
            });
        },
        newPay() {
            this.dialog = true;
        },
        closeNewPayment() {
            this.dialog = false;
        },
        savePay() {
            this.nuevoPago.padre_id = this.$route.params.id;
            // TODO: usuarios que registran el pago
            this.nuevoPago.user_id = 1;

            console.log(this.nuevoPago);

            axios
                .post("api/pagos", this.nuevoPago)
                .then(response => {
                    if (response.status === 200) {
                        this.getPadre();
                        this.closeNewPayment();
                    }
                })
                .catch(error => {})
                .finally(() => {
                    //Perform action in always
                });
        },
        print() {
            this.$router.push("/profile2PDF/" + this.padre.id);
        }
    },
    created() {
        this.getPadre();
    }
};
</script>
