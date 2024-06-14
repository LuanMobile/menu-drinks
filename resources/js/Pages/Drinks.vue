<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm } from '@inertiajs/vue3';

const { filters } = defineProps(['drinks', 'meals', 'filters']);
const form = useForm("getparams", { c: filters.c });

const submit = () => {
    form.get(route('drinks'));
}

const redirectToDrink = (drink) => {
    window.location.href = `/drinks/drink?i=${drink.idDrink}`;
}
</script>

<template>
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h2 class="text-5xl font-semibold mb-4 text-center">Enter your drink</h2>
                <form @submit.prevent="submit">
                    <div class="flex flex-col items-center">
                        <div class="w-full max-w-md mb-4">
                            <InputLabel for="c" value="Name" />
                            <TextInput placeholder="Name of the drink" id="c" type="text" class="mt-1 block w-full"
                                v-model="form.c" />
                        </div>
                        <div class="col-span-4 lg:col-span-2">
                            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Search
                            </PrimaryButton>
                            <a @click.prevent="downloadFile"
                                class="cursor-pointer ml-4 inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150">
                                Download
                            </a>
                        </div>
                    </div>
                </form>
            </div>
            <template v-for="(drinkGroup, drinkIndex) in drinks" :key="drinkIndex">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
                    <h2 class="text-2xl font-semibold mb-4">Drinks</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        <template v-for="drink in drinkGroup" :key="drink.idDrink">
                            <div class="drink-card rounded-lg shadow-md overflow-hidden "
                                @click="redirectToDrink(drink)">
                                <img :src="drink.strDrinkThumb" :alt="drink.strDrink"
                                    class="w-full h-40 object-cover" />
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold">{{ drink.strDrink }}</h3>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </template>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped></style>