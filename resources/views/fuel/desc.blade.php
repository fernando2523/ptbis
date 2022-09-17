<div class="modal fade" id="modaldesc" data-bs-backdrop="static">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Description</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="form-group col-12 mb-3">
                    <input type="hidden" id="d_id">
                    @empty($value->desc)
                    <textarea class="form-control text-theme" id="d_desc" rows="3" readonly></textarea>
                    @else
                    <textarea class="form-control text-theme"  id="d_desc" rows="3" readonly>{{ $value->desc }}</textarea>
                    @endempty
                    
                </div>
            </div>
        </div>
    </div>
</div>