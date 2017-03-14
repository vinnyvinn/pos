    {{ csrf_field() }}
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                <label for="code" class="control-label">Tax Code</label>
                <input type="text" class="form-control" id="code" name="code" required value="{{ $tax->code or old('code') }}">
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('code') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('rate') ? ' has-error' : '' }}">
                <label for="rate" class="control-label">Tax Rate</label>
                <input type="text" title="Numeric with optional decimal" pattern="[0-9\.]+$" class="form-control" id="rate" name="rate" required value="{{ $tax->rate or old('rate') }}">
                @if ($errors->has('description'))
                    <span class="help-block">
                        <strong>{{ $errors->first('rate') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="is_active" {{ $tax->rate or old('is_active') ? 'checked' : '' }}> Is Active?
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




