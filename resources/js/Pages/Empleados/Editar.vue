<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({ empleado: { type: Array } });
const form = useForm({
    nombre: props.empleado.nombre,
    correo: props.empleado.correo,
    clave: props.empleado.clave,
    ResetPw: props.empleado.ResetPw
  
});

</script>

<template>
    <Head title="Editar empleado" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar empleado</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <form @submit.prevent="$event => form.patch(route('empleados.update', empleado))"
                        class="mt6 space-y-6 max-w-xl">
                        <InputLabel for="nombre" value="Empleado"></InputLabel>
                        <TextInput id="nombre" v-model="form.nombre" autofocus required
                            type="text" class="mt-1 block w-full" placeholder="Ingrese Nombre"></TextInput>
                        <InputError :message="form.errors.nombre" class="mt-2"></InputError>
                        <TextInput id="correo" v-model="form.correo" required
                            type="email" class="mt-1 block w-full" placeholder="Ingrese Correo"></TextInput>
                        <InputError :message="form.errors.correo" class="mt-2"></InputError>
                        <TextInput id="clave" v-model="form.clave" required
                            type="password" class="mt-1 block w-full" placeholder="Ingrese Clave"></TextInput>
                        <InputError :message="form.errors.clave" class="mt-2"></InputError>
                      
                        <InputError :message="form.errors.ResetPw" class="mt-2"></InputError>
                        <PrimaryButton :disable="form.processing">
                            <i class="fa-solid fa-save"></i>  Guardar
                        </PrimaryButton>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
