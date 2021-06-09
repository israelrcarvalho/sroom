{{-- Confirm Delete --}}
<div class="modal fade" id="modal-delete-{{$periodo->id}}" tabIndex="-1">
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
                    Deseja mesmo excluir esta data?
                </p>
            </div>
            <div class="modal-footer">
                <form method="GET"
                      action="{{ route('periodos.destroy',['id'=>$periodo->id]) }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-danger"><i
                                class="fa fa-times-circle"></i>
                        Sim
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- --}}