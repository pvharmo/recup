<template>
    <app-layout>
        <template #header>
            <div class="flex justify-between">
                <div>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        Liste des entrées de denrées
                    </h2>
                </div>
                <div>
                    <inertia-link :href="'/entries/create'">
                        <btn>
                            Nouvelle entrée
                        </btn>
                    </inertia-link>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                        <table class="table-auto">
                            <tr>
                                <th class="border px-4 py-2">Date de réception</th>
                                <th class="border px-4 py-2">Fournisseur</th>
                                <th class="border px-4 py-2">Catégorie</th>
                                <th class="border px-4 py-2">Quantité (kg)</th>
                                <th class="border px-4 py-2">Éditer</th>
                            </tr>
                            <tr v-for="entry in entries" v-bind:key="entry.id">
                                <td class="border px-4 py-2">{{entry.reception_date}}</td>
                                <td class="border px-4 py-2">{{supplier(entry).name}}</td>
                                <td class="border px-4 py-2">{{category(entry).name}}</td>
                                <td class="border px-4 py-2">{{entry.amount}}</td>
                                <td class="border px-4 py-2">
                                    <inertia-link :href="'/entries/' + entry.id + '/edit'">
                                        <jet-button>Éditer</jet-button>
                                    </inertia-link>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from './../../Layouts/AppLayout'
    import JetButton from './../../Jetstream/Button'
    import Btn from './../../components/Button'

    export default {
        props: [
            'entries',
            'suppliers',
            'categories'
        ],
        components: {
            AppLayout,
            JetButton,
            Btn
        },
        methods: {
            supplier(entry) {
                return this.suppliers.find(x => x.id == entry.supplier_id)
            },
            category(entry) {
                return this.categories.find(x => x.id == entry.category_id)
            }
        }
    }
</script>