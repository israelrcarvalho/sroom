{{-- Confirm Delete --}}
<div class="modal fade" id="modal-delete-recurso-{{$recurso->id}}" tabIndex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    &times;
                </button>
                <h4 class="modal-title">Por favor Confirmar</h4>
            </div>
            <div class="modal-body">
                <p class="lead">
                    <i class="fa fa-question-circle fa-lg"></i> &nbsp;
                    Tem certeza de que deseja excluir <br/>este item do evento ?
                </p>
            </div>
            <div class="modal-footer">
                <form method="GET"
                      action="{{ route('deletarRecursosDoEventoModal',['id'=>$recurso->id]) }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-danger"><i
                                class="fa fa-times-circle"></i> Sim
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- --}}