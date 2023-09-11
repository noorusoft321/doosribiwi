<form id="personalNoteForm" class="row">
    <div class="col-md-12 py-xl-10">
        <div class="form-group">
            <label class="form-label">*Personal Note</label>
            <textarea name="persona_note" class="form-control" cols="90" rows="7">{{(!empty($customer->customerOtherInfo)) ? $customer->customerOtherInfo->persona_note : ''}}</textarea>
        </div>
    </div>
</form>