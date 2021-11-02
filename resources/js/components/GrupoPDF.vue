<template>
    <div>
        <vue-html2pdf
            :show-layout="false"
            :float-layout="true"
            :enable-download="true"
            :preview-modal="true"
            :paginate-elements-by-height="1400"
            filename="grupo"
            :pdf-quality="2"
            :manual-pagination="false"
            pdf-format="a4"
            pdf-content-width="800px"
            ref="html2Pdf"
        >
            <section slot="pdf-content">
                <v-container class="arabic-text" m-16>
                    <h2 class="mr-10">
                        {{ "Grupo: " + grupo.dia + " " + grupo.horario }}
                        {{ "Nivel:" }}

                        <span v-if="grupo.nivel == 0"> {{ "INFANTIL" }}</span>
                        <span v-else> {{ grupo.nivel + "º " }}</span>

                        <v-spacer></v-spacer>
                    </h2>
                    <v-divider></v-divider>
                    <v-simple-table dense class="p-10 m-10">
                        <template v-slot:default>
                            <thead>
                                <tr>
                                    <th class="text-left">
                                        Nombre
                                    </th>
                                    <th class="text-left">
                                        Apellido
                                    </th>
                                    <th class="text-left">
                                        الإسم
                                    </th>
                                    <th class="text-left">
                                        اللقب
                                    </th>
                                    <th class="text-left">
                                        Fecha de nacimiento
                                    </th>
                                    <th class="text-left">
                                        Teléfono de contacto
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in alumnos" :key="item.id">
                                    <td>{{ item.name }}</td>
                                    <td>{{ item.surname }}</td>
                                    <td>{{ item.name_ar }}</td>
                                    <td>{{ item.surname_ar }}</td>
                                    <td>{{ item.birthday }}</td>
                                    <td>{{ item.telefono }}</td>
                                </tr>
                            </tbody>
                        </template>
                    </v-simple-table>
                    <v-divider></v-divider>
                </v-container>
            </section>
        </vue-html2pdf>
    </div>
</template>

<script>
import VueHtml2pdf from "vue-html2pdf";

export default {
    name: "ProfilePDF",
    props: ["print", "alumnos", "grupo"],
    data() {
        return {
            headers: [
                { text: "ID", value: "id" },
                { text: "Nombre", value: "name" },
                { text: "Apellido", value: "surname" },
                { text: "الإسم", value: "name_ar" },
                { text: "اللقب", value: "surname_ar" },
                { text: "Fecha de Nacimiento", value: "birthday" },
                { text: "Teléfono de contacto", value: "telefono" }
            ]
        };
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
