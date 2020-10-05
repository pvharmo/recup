<template>
    <app-layout>
            <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Modifier une entrée
                </h2>
            </template>

            <div>
                <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                    <jet-form-section @submitted="editEntry">
                        <template #title>
                            Éditer une entrée de denrée
                        </template>

                        <template #description>
                            <div>
                                Modifier les données de l'entrée de denrée.
                            </div>
                            <inertia-link :href="'/entries'">
                                <cancel-button class="my-4">Retour</cancel-button>
                            </inertia-link>
                        </template>

                        <template #form>
                            <!-- Token Name -->
                            <div class="col-span-6 sm:col-span-4">
                                <jet-label for="amount" value="Quantité (kg)" />
                                <jet-input id="name" type="date" class="mt-1 block w-full" v-model="editEntryForm.reception_date" autofocus />
                                <jet-input-error :message="editEntryForm.error('reception_date')" class="mt-2" />
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <jet-label for="amount" value="Quantité (kg)" />
                                <jet-input id="name" type="number" class="mt-1 block w-full" v-model="editEntryForm.amount" autofocus />
                                <jet-input-error :message="editEntryForm.error('amount')" class="mt-2" />
                            </div>

                            <div class="col-span-6">
                                <jet-label for="category" value="Catégorie" />

                                <div class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <label class="flex items-center">
                                        <select v-model="editEntryForm.category_id">
                                            <option v-for="category in categories" v-bind:value="category.id" v-bind:key="category.id">
                                                {{ category.name }}
                                            </option>
                                        </select>
                                    </label>
                                </div>
                            </div>

                            <div class="col-span-6">
                                <jet-label for="supplier" value="Fournisseur" />

                                <div class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <label class="flex items-center">
                                        <select v-model="editEntryForm.supplier_id">
                                            <option v-for="supplier in suppliers" v-bind:value="supplier.id" v-bind:key="supplier.id">
                                                {{ supplier.name }}
                                            </option>
                                        </select>
                                    </label>
                                </div>
                            </div>
                        </template>
                        <template #actions>
                            <jet-action-message :on="editEntryForm.recentlySuccessful" class="mr-3">
                                Enregistré.
                            </jet-action-message>

                            <delete-button @click="deleteEntry" :class="{ 'opacity-25': editEntryForm.processing, 'mx-4': true }" :disabled="editEntryForm.processing">
                                Supprimer
                            </delete-button>

                            <jet-button :class="{ 'opacity-25': editEntryForm.processing }" :disabled="editEntryForm.processing">
                                Enregistrer
                            </jet-button>
                        </template>
                    </jet-form-section>
                </div>
            </div>
    </app-layout>
</template>

<script>
    import AppLayout from './../../Layouts/AppLayout'
    import JetSectionBorder from './../../Jetstream/SectionBorder'
    import JetFormSection from './../../Jetstream/FormSection'
    import JetLabel from './../../Jetstream/Label'
    import JetInput from './../../Jetstream/Input'
    import JetInputError from './../../Jetstream/InputError'
    import JetButton from './../../Jetstream/Button'
    import JetActionMessage from './../../Jetstream/ActionMessage'
    import DeleteButton from './../../components/DeleteButton'
    import CancelButton from './../../components/Button'

    export default {
        props: [
            'tokens',
            'defaultPermissions',
            'suppliers',
            'categories',
            'entry'
        ],

        components: {
            AppLayout,
            JetSectionBorder,
            JetFormSection,
            JetLabel,
            JetInput,
            JetInputError,
            JetButton,
            JetActionMessage,
            DeleteButton,
            CancelButton
        },

        data() {
            return {
                editEntryForm: this.$inertia.form({
                    amount: this.entry.amount,
                    reception_date: this.entry.reception_date,
                    category_id: this.entry.category_id,
                    supplier_id: this.entry.supplier_id
                }, {
                    bag: 'editEntry',
                    resetOnSuccess: true,
                })
            }
        },

        methods: {
            editEntry() {
                this.editEntryForm.put('/entries/' + this.entry.id)
            },
            deleteEntry() {
                if (confirm("Êtes-vous sûr de vouloir supprimer l'entrée?")) {
                    this.$inertia.delete('/entries/' + this.entry.id)
                }
            }
        }
    }
</script>