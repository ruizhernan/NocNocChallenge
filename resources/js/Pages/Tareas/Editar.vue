<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({ tarea: { type: Object }})
const form = useForm({
    titulo: props.tarea.titulo,
    descripcion: props.tarea.descripcion,
    estado: props.tarea.estado,
    empleado_id: parseInt(props.tarea.empleado_id) 
  
});

</script>

<template>
    <Head title="Editar tarea" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar tarea</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <form @submit.prevent="$event => form.patch(route('tareas.update', tarea))"
                        class="mt6 space-y-6 max-w-xl">
                        <InputLabel for="nombre" value="Tarea"></InputLabel>
                        <TextInput id="titulo" v-model="form.titulo" 
                            type="text" class="mt-1 block w-full opacity-50" placeholder="Ingrese titulo" ></TextInput>
                        <InputError :message="form.errors.titulo" class="mt-2"></InputError>
                        <TextInput id="descripcion" v-model="form.descripcion" 
                            type="text" class="mt-1 block w-full opacity-50" placeholder="Ingrese descripción" readonly></TextInput>
                        <InputError :message="form.errors.descripcion" class="mt-2"></InputError>
                        <div>
                         <InputLabel for="estado" value="Estado"></InputLabel>
                             <div class="mt-1">
                            <label for="asignada" class="mr-4">
                                <input type="radio" id="asignada" value="Asignada" v-model="form.estado"> Asignada
                            </label>
                            <label for="en_proceso" class="mr-4">
                                <input type="radio" id="en_proceso" value="En proceso" v-model="form.estado"> En proceso
                            </label>
                            <label for="finalizada">
                                <input type="radio" id="finalizada" value="Finalizada" v-model="form.estado"> Finalizada
                            </label>
                          </div>
                        </div>
            <InputError :message="form.errors.estado" class="mt-2"></InputError>
                        <TextInput id="empleado_id" v-model.number="form.empleado_id" 
                            type="number" class="mt-1 block w-full" placeholder="Modifique empleados"></TextInput>
                        <InputError :message="form.errors.empleado_id" class="mt-2"></InputError>
                        <PrimaryButton :disable="form.processing">
                            <i class="fa-solid fa-save"></i>  Guardar
                        </PrimaryButton>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
