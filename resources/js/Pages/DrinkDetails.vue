<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps(['drink'])
console.log(props.drink)
</script>

<template>
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <template v-for="(value, id) in drink" :key="id">
                    <div v-for="drink in value" :key="drink.idDrink"
                        class="bg-white shadow-md rounded-lg p-6 mb-8 flex flex-col sm:flex-row">
                        <div class="sm:w-1/3">
                            <img :src="drink.strDrinkThumb" alt="Drink Image" class="w-full rounded mb-4 sm:mb-0">
                            <h1 class="text-3xl font-bold mb-4 sm:mb-0">{{ drink.strDrink }}</h1>
                        </div>
                        <div class="sm:w-2/3 sm:pl-6">
                            <ul class="list-none p-0">
                                <li v-if="drink.strIngredient1" class="mb-2">{{ drink.strIngredient1 }}</li>
                                <li v-if="drink.strIngredient2" class="mb-2">{{ drink.strIngredient2 }}</li>
                                <li v-if="drink.strIngredient3" class="mb-2">{{ drink.strIngredient3 }}</li>
                                <li v-if="drink.strIngredient4" class="mb-2">{{ drink.strIngredient4 }}</li>
                                <!-- Adicione mais ingredientes conforme necessário -->
                            </ul>

                            <p class="mt-4"><span>Instruções: </span>{{ drink.strInstructions }}</p>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped></style>