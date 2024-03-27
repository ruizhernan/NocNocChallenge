<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';



const form = useForm({
    titulo:'',
    descripcion: '',
    estado: '',
    empleado_id: 0
});


</script>

<template>
    <Head title="Crear tarea" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Crear tarea</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <form @submit.prevent="$event => form.post(route('tareas.store'))"
                        class="mt6 space-y-6 max-w-xl">
                        <InputLabel for="tarea" value="Tarea"></InputLabel>
                        <TextInput id="titulo" v-model="form.titulo" 
                            type="text" class="mt-1 block w-full" placeholder="Ingrese titulo" ></TextInput>
                        <InputError :message="form.errors.titulo" class="mt-2"></InputError>
                        <TextInput id="descripcion" v-model="form.descripcion" 
                            type="text" class="mt-1 block w-full" placeholder="Ingrese descripción" ></TextInput>
                        <InputError :message="form.errors.descripcion" class="mt-2"></InputError>
                        <TextInput id="estado" v-model="form.estado" 
                            type="text" class="mt-1 block w-full" placeholder="Ingrese Estado" ></TextInput>
                        <InputError :message="form.errors.estado" class="mt-2"></InputError>
                        <TextInput id="empleado_id" v-model.number="form.empleado_id" 
                            type="number" class="mt-1 block w-full" placeholder="Ingrese empleado"></TextInput>
                        <InputError :message="form.errors.empleado_id" class="mt-2"></InputError>
                        <PrimaryButton :disable="form.processing">
                            <i class="fa-solid fa-save"></i> Guardar
                        </PrimaryButton>

                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
