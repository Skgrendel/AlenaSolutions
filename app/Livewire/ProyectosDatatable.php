<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Proyectos;

class ProyectosDatatable extends DataTableComponent
{
    protected $model = Proyectos::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
          $this->setTableAttributes([
            'default' => false,
            'class' => 'table',
          ]);
    }

    public function columns(): array
    {
        return [
            Column::make("Nombre", "nombre")
                ->sortable(),
            Column::make("Descripcion", "descripcion")
                ->sortable(),
            Column::make("Area", "area")
                ->sortable(),
            Column::make("Fecha estimada", "fecha_estimada")
                ->sortable(),
            Column::make("Avance", "avance")
                ->sortable(),
            Column::make("Prioridad", "prioridad")
                ->sortable(),
            Column::make("Estado", "estado")
                ->sortable(),
            Column::make("Fecha inicio", "fecha_inicio")
                ->sortable(),
            Column::make("Fecha final", "fecha_final")
                ->sortable(),
            Column::make("Personal asignado", "personal_asignado")
                ->sortable(),
        ];
    }
}
