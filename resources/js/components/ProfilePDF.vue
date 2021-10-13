<template>
    <div>
        <vue-html2pdf
            :show-layout="false"
            :float-layout="true"
            :enable-download="true"
            :preview-modal="true"
            :paginate-elements-by-height="1400"
            filename="fichaPadre"
            :pdf-quality="2"
            :manual-pagination="false"
            pdf-format="a4"
            pdf-content-width="800px"
            ref="html2Pdf"
        >
            <section slot="pdf-content">
                <v-card flat>
                    <v-card-title>
                        Escuela de árabe Abu Al-Qasem de Zaragoza
                    </v-card-title>

                    <v-divider></v-divider>

                    <v-card-text>
                        <!-- NOMBRE Y APELLIDO -->
                        <v-list-item>
                            <v-list-item-icon>
                                <v-icon color="indigo" class="icon">
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

                            <!-- DNI-->
                            <v-list-item-icon>
                                <v-icon color="indigo" class="icon">
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
                            <!-- Phone -->
                            <v-list-item-icon>
                                <v-icon color="indigo" class="icon">
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

                        <!-- Mail-->
                        <v-list-item>
                            <v-list-item-icon>
                                <v-icon color="indigo" class="icon">
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

                            <!-- Address-->
                            <v-list-item-icon>
                                <v-icon color="indigo" class="icon">
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
                            <v-list-item-content> </v-list-item-content>
                        </v-list-item>
                    </v-card-text>
                </v-card>
                <v-divider></v-divider>

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
                                    <v-icon color="indigo" class="icon">
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
                                        dateFormat(hijo.birthday)
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

                <v-divider></v-divider>
                <v-card flat>
                    <v-card-text>
                        <v-list v-for="(pago, index) in pagos" :key="index">
                            <!-- PAGO -->
                            <v-list-item>
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
                        </v-list>
                    </v-card-text>
                    <v-divider></v-divider>
                </v-card>
            </section>
        </vue-html2pdf>
    </div>
</template>

<script>
import VueHtml2pdf from "vue-html2pdf";

export default {
    name: "ProfilePDF",
    props: ["print", "padre", "hijos", "pagos"],
    data() {
        return {};
    },
    watch: {
        print(value) {
            if (value === true) {
                this.generateReport();
            }
            this.$emit("printed");
        }
    },
    methods: {
        generateReport() {
            this.$refs.html2Pdf.generatePdf();
            this.dateFormat();
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
        }
    },
    components: {
        VueHtml2pdf
    }
};
</script>

<style>
.icon {
    margin: 5px;
    padding: 5px;
}
</style>
