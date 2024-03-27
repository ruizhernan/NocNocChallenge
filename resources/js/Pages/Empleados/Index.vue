<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import axios from 'axios';



const props = defineProps({
    empleados: {type:Object}
})
const form = useForm({
    id: props.empleados.id,
    nombre: props.empleados.nombre,
    correo: props.empleados.correo,
    clave: props.empleados.clave,
    ResetPw : props.empleados.ResetPw
})

const eliminarEmpleado = (id, nombre) => {
    const alerta = Swal.mixin({
        buttonStyling: true
    });
    alerta.fire({
        title: 'Desea borrar el empleado '+nombre+'?',
        icon:'question', showCancelButton:true,
        confirmButtonText:'<i class="fa-solid fa-check"></i> Si, eliminar',
        cancelButtonText:'<i class="fa-solid fa-ban"></i> Cancelar'
    }).then((result) => {
        if(result.isConfirmed){ 
            form.delete(route('empleados.destroy', id))
            console.log('Empleado eliminado', id)
        }
    })
    .catch((error) => {
        console.error("Error al eliminar empleado: ", error);
    });
}

</script>

<template>
    <Head title="Empleados" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Empleados</h2>
        </template>

        <div class="py-12">
            <div class="bg-white grid v-screen place-items-center">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="mt-3 mb-3 flex">
                        <Link :href="route('empleados.create')" 
                        :class="'px-4 py-2 bg-gray-800 text-white border rounded-md font-semibold text-xs'">
                            <i class="fa-solid fa-plus-circle "> Agregar</i> 
                        </Link>                    
                    </div>
                </div>
                <div class="bg-white grid v-screen place-items-center">
                    <table class="table-auto border border-gray-400">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-4">#</th>
                                <th class="px-4 py-4">Empleado</th>
                                <th class="px-4 py-4"></th>
                                <th class="px-4 py-4"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="emp, i in empleados" :key="emp.id">
                            <td class="border border-gray-400 px-4 py-4">{{ emp.id }}</td>
                            <td class="border border-gray-400 px-4 py-4">{{ emp.nombre }}</td>
                            <td class="border border-gray-400 px-4 py-4">
                        <Link :href="route('empleados.edit', emp.id)" 
                              :class="'px-4 py-2 bg-yellow-500 text-white border rounded-md font-semibold text-xs'">
                                <i class="fa-solid fa-edit"></i> 
                        </Link> 
                            </td>
                            <td class="border border-gray-400 px-4 py-4">
                                <DangerButton @click="$event => eliminarEmpleado(emp.id, emp.nombre)">
                                 <i class="fa-solid fa-trash"></i> 
                                    </DangerButton>
                            </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
