<div class="card-box border-top">
    <table id="trecursosxx" class="table table-striped">
        <thead>
        <tr>
            <th style="width: 3%;"></th>

            <th>Nome</th>
            <th style="width: 3%;">Sigla</th>
            <th width="11"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($p->singleRecurso as $recurso)

            <tr>
                <td align="center">
                     <span class="glyphicon glyphicon-edit" style="cursor:pointer;"
                           data-toggle="modal"
                           data-target="#modal-editar-recurso-{{$recurso->id}}"/>
                </td>
                <td>
                    @if($recurso->id)
                        {{ $recurso->recursoById($recurso->recurso_id)->nome }}
                    @endif
                </td>
                <td> {{ $recurso->recursoById($recurso->recurso_id)->sigla }}</td>
                <td align="center">
                                <span style="cursor:pointer;"
                                      class="glyphicon glyphicon-trash"
                                      data-toggle="modal"
                                      data-target="#modal-delete-recurso-{{$recurso->id}}"></span>
                </td>
            </tr>
            @include('eventos.partials.modal-editar-recurso')
            @include('eventos.partials.modal-deletar-recurso')
        @endforeach
        </tbody>
    </table>

    <div class="row">

        <div class="col-sm-12 text-right">

            <button type="button" class="btn btn-success text-right"
                    data-toggle="modal" data-target="#modal-create-recurso"
                    name="action" value="finished">
                <i class="fa fa-calendar"></i> Novo recurso
            </button>
        </div>

    </div>
</div>