<template>
    <div>
        <nav-bar></nav-bar>

        <v-card class="mx-auto mt-10 arabic-text" max-width="92%">
            <v-toolbar flat color="primary" dark>
                <v-toolbar-title>Ficha Padre</v-toolbar-title>
            </v-toolbar>
            <v-tabs vertical>
                <v-tab>
                    <v-icon left> mdi-account </v-icon>
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
                                            <v-btn
                                                class="mx-2 whatsapp-button"
                                                fab
                                                small
                                                color="green"
                                                outlined
                                                @click="goToWhatsApp"
                                            >
                                                <v-icon> mdi-whatsapp </v-icon>
                                            </v-btn>
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
                                        <v-list-item-subtitle>
                                            <span v-if="hijo.nivel == 0">
                                                {{ "INFANTIL" }}</span
                                            >
                                            <span v-if="hijo.nivel == null">
                                                {{ " - " }}</span
                                            >
                                            <span v-else>
                                                {{ hijo.nivel + "º " }}</span
                                            >
                                            {{
                                                " - " +
                                                hijo.dia +
                                                " - " +
                                                hijo.horario
                                            }}
                                        </v-list-item-subtitle>
                                    </v-list-item-content>
                                </v-list-item>
                                <v-divider></v-divider>
                            </v-list>
                        </v-card-text>
                    </v-card>
                </v-tab-item>

                <v-tab-item>
                    <v-card flat>
                        <v-card-text>
                            <v-list v-for="(pago, index) in pagos" :key="index">
                                <v-list-item>
                                    <v-list-item-icon>
                                        <v-icon color="indigo">
                                            mdi-check
                                        </v-icon>
                                    </v-list-item-icon>

                                    <v-list-item-content>
                                        {{
                                            "Fecha:   " +
                                            dateFormat(pago.created_at)
                                        }}
                                    </v-list-item-content>
                                    <v-list-item-content>
                                        {{ "Cantidad:   " + pago.cantidad }}
                                    </v-list-item-content>
                                </v-list-item>
                                <v-divider></v-divider>
                            </v-list>
                        </v-card-text>
                    </v-card>
                </v-tab-item>
            </v-tabs>
        </v-card>

        <v-container class="buttons" ml-16>
            <v-btn color="warning" x-large dark type="submit" @click="newPay()">
                Nuevo pago
            </v-btn>
            <v-btn
                color="primary"
                x-large
                dark
                type="submit"
                @click="printPDF()"
            >
                Imprimir
            </v-btn>
        </v-container>

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

        <profile-pdf
            v-bind:print="print"
            v-bind:padre="padre"
            v-bind:hijos="hijos"
            v-bind:pagos="pagos"
            v-on:printed="print = false"
        ></profile-pdf>
    </div>
</template>

<script>
import NavBar from "./NavBar.vue";
import ProfilePdf from "./ProfilePDF.vue";

export default {
    name: "padre",
    components: { NavBar, ProfilePdf },
    props: ["padre_id"],
    data() {
        return {
            dialog: false,
            print: false,
            tab: null,
            padre: {},
            hijos: [],
            pagos: [],
            nuevoPago: {
                padre_id: "",
                user_id: "",
                cantidad: "",
            },
        };
    },
    methods: {
        getPadre() {
            axios
                .get("/api/padres/" + this.$route.params.id)
                .then((response) => {
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

            axios
                .post("api/pagos", this.nuevoPago)
                .then((response) => {
                    if (response.status === 200) {
                        this.getPadre();
                        this.closeNewPayment();
                    }
                })
                .catch((error) => {})
                .finally(() => {
                    //Perform action in always
                });
        },
        printPDF() {
            this.print = true;
        },
        dateFormat(isoDate) {
            const date = new Date(isoDate);

            return (
                date.getDate() +
                "-" +
                (date.getMonth() + 1) +
                "-" +
                date.getFullYear()
            );
        },
        goToWhatsApp() {
            window.open(
                "https://api.whatsapp.com/send?phone=34" +
                    this.padre.telefono +
                    "&attachment=C:/Users/Ahmad/DownloadfichaPadre.pdf"
            );
        },
    },
    created() {
        this.getPadre();
    },
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
