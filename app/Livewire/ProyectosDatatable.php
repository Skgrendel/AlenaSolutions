<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Models\proyectos;

class ProyectosDatatable extends DataTableComponent
{
    protected $model = proyectos::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function ($row) {
                return route('proyectos.actividades', $row);
            });

        $this->setTableAttributes([
            'class' => 'table custom-table',
        ]);

        $this->setDefaultSort('Created_at', 'desc');
    }

    public function columns(): array
    {
        return [
            Column::make("Nombre", "nombre")
             ->searchable()
                ->sortable(),
            Column::make("Area", "areas.nombre")
                ->sortable(),
            Column::make("Fecha Creacion", "Created_at")
                ->format(fn($value) => \Carbon\Carbon::parse($value)->format('d/m/Y h:i A'))
                ->sortable(),
            Column::make("Fecha estimada", "fecha_estimada")
                ->format(fn($value) => \Carbon\Carbon::parse($value)->format('d/m/Y'))
                ->sortable(),
            Column::make("Fecha Inicio", "fecha_inicio")
                ->sortable()
                ->format(fn($value) => \Carbon\Carbon::parse($value)->format('d/m/Y h:i A'))
                ->collapseAlways(),
            Column::make("Fecha Final", "fecha_final")
                ->format(fn($value) => \Carbon\Carbon::parse($value)->format('d/m/Y h:i A'))
                ->sortable()
                ->collapseAlways(),
            Column::make("Avance", "avance")
                ->format(
                    fn($value) => '
                        <div class="progress text-dark" style="height:10px;">
                            <div class="progress-bar progress-bar-striped bg-success" role="progressbar"
                                style="width:' . $value . '%;"
                                aria-valuenow="' . $value . '" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>' . $value . '%'
                )
                ->html(),
            Column::make("Prioridad", "prioridad")
                ->format(
                    fn($value, $row, Column $column) => match ($value) {
                        '4' => '<span class="badge badge-success">Finalizado</span>',
                        '5' => '<span class="badge badge-info">Baja</span>',
                        '6' => '<span class="badge badge-warning">Media</span>',
                        '7' => '<span class="badge badge-danger">Alta</span>',
                    }
                )
                ->html()
                ->collapseOnMobile(),
            Column::make("Estado", "estado")
                ->format(
                    fn($value, $row, Column $column) => match ($value) {
                        '1' => '<span class="badge badge-danger">Pendiente</span>',
                        '2' => '<span class="badge badge-warning">En curso</span>',
                        '3' => '<span class="badge badge-success">Finalizado</span>',
                    }
                )
                ->html()
                ->collapseOnMobile(),
            Column::make('Acciones', 'id')
                ->unclickable()
                ->format(
                    fn($value, $row, Column $column) => view('proyectos.actions', compact('value'))
                ),

        ];
    }

    public function builder(): Builder
    {
        $query = proyectos::query();

        if (!Auth::user()->hasRole('Administrador')) {
            $query->where('user_id', auth()->id());
        }

        return $query;
    }

}
