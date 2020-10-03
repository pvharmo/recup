<template>
    <app-layout>
            <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Nouvelle entrée
                </h2>
            </template>

            <div>
                <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                    <jet-form-section @submitted="createEntry">
                        <template #title>
                            Créer une nouvelle entrée
                        </template>

                        <template #description>
                            Ajouter une nouvelle entrée de denrée
                        </template>

                        <template #form>
                            <!-- Token Name -->
                            <div class="col-span-6 sm:col-span-4">
                                <jet-label for="amount" value="Quantité (kg)" />
                                <jet-input id="name" type="date" class="mt-1 block w-full" v-model="createEntryForm.reception_date" autofocus />
                                <jet-input-error :message="createEntryForm.error('reception_date')" class="mt-2" />
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <jet-label for="amount" value="Quantité (kg)" />
                                <jet-input id="name" type="number" class="mt-1 block w-full" v-model="createEntryForm.amount" autofocus />
                                <jet-input-error :message="createEntryForm.error('amount')" class="mt-2" />
                            </div>

                            <div class="col-span-6">
                                <jet-label for="category" value="Catégorie" />

                                <div class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <label class="flex items-center">
                                        <select v-model="createEntryForm.category_id">
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
                                        <select v-model="createEntryForm.supplier_id">
                                            <option v-for="supplier in suppliers" v-bind:value="supplier.id" v-bind:key="supplier.id">
                                                {{ supplier.name }}
                                            </option>
                                        </select>
                                    </label>
                                </div>
                            </div>
                        </template>
                        <template #actions>
                            <jet-action-message :on="createEntryForm.recentlySuccessful" class="mr-3">
                                Created.
                            </jet-action-message>

                            <jet-button :class="{ 'opacity-25': createEntryForm.processing }" :disabled="createEntryForm.processing">
                                Create
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

    export default {
        props: [
            'tokens',
            'defaultPermissions',
            'suppliers',
            'categories'
        ],

        components: {
            AppLayout,
            JetSectionBorder,
            JetFormSection,
            JetLabel,
            JetInput,
            JetInputError,
            JetButton,
            JetActionMessage
        },

        data() {
            return {
                createEntryForm: this.$inertia.form({
                    amount: '',
                    reception_date: '',
                    category_id: null,
                    supplier_id: null
                }, {
                    bag: 'createEntry',
                    resetOnSuccess: true,
                })
            }
        },

        methods: {
            createEntry() {
                this.createEntryForm.post('/entries')
            }
        }
    }
</script>