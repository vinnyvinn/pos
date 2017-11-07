    {{ csrf_field() }}
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                <label for="code" class="control-label">Tax Code</label>
                <input type="text" class="form-control" id="code" name="code" required value="{{ $tax->code or old('code') }}">
                @if ($errors->has('code'))
                    <span class="help-block">
                        <strong>{{ $errors->first('code') }}</strong>
                    </span>
                @endif
            </div>


            <div class="form-group{{ $errors->has('rate') ? ' has-error' : '' }}">
                <label for="rate" class="control-label">Tax Rate</label>
                <div class="input-group">
                    <input aria-describedby="basic-addon1" type="text" title="Numeric with optional decimal" pattern="[0-9\.]+$" class="form-control" id="rate" name="rate" required value="{{ $tax->rate or old('rate') }}">
                    <span class="input-group-addon" id="basic-addon1">%</span>
                </div>
                @if ($errors->has('description'))
                    <span class="help-block">
                        <strong>{{ $errors->first('rate') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="is_active" {{ $tax->is_active or old('is_active') ? 'checked' : '' }}> Is Active?
                    </label>
                </div>
            </div>

        </div>

        <div class="col-sm-6">
            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                <label for="description" class="control-label">Description</label>
                <textarea rows="5" class="form-control" id="description" name="description">{{ $tax->description or old('description') }}</textarea>
                @if ($errors->has('description'))
                    <span class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
            </div>
        </div>

    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-success" value="Save">
        <a href="{{ route('tax.index') }}" class="btn btn-danger">Back</a>
    </div>
