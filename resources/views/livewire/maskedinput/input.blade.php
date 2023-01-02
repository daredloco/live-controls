<div>
    @once
        @push('scripts')
            <script src="https://unpkg.com/imask"></script>

            <script type="text/javascript">
                window.{{ $inputID }}mask = IMask(
                    document.getElementById('{{ $inputID }}'),
                    {
                        @if($inputType == 'currency')
                            mask: 'num',
                            blocks: {
                                num: {
                                    // nested masks are available!
                                    mask: Number,
                                    scale: 2,
                                    padFractionalZeros: true,
                                    normalizeZeros: false,
                                    radix: ',',
                                    thousandsSeparator: '.'
                                }
                            }
                        @else
                            @if(is_null($masks))
                                mask: '{{ $mask }}'
                            @else
                                mask: {!! $masks !!}
                            @endif
                        @endif
        
                    }
                );
        
                document.addEventListener("DOMContentLoaded", () => {
                    @if(!is_null($cleanValue))
                        window.{{ $inputID }}mask.value = "{{ $cleanValue }}";
                    @endif
                });
        
                Livewire.on('{{ $inputID }}-valueUpdated', value => {
                    @this.cleanValue = window.{{ $inputID }}mask.unmaskedValue;
                });
            </script>
        @endpush        
    @endonce
    
    @if(!is_null($label))
        <label for="{{ $inputID }}" class="form-label">{{ $label }}</label>
    @endif
    @if(!is_null($helperText))
    <br>
        <small class="text-muted">{{ $helperText }}</small>
    @endif
        <input type="{{ $inputType == 'currency' ? 'text' : $inputType }}"
            class="form-control" name="{{ $inputID }}" id="{{ $inputID }}" placeholder="{{ $placeholder }}" wire:model.debounce.500ms='value' @if($required) required @endif>
    @if(!is_null($cleanID))
        <input type="hidden" name="{{ $cleanID }}" id="{{ $cleanID }}" value="{{ $cleanValue }}">
    @endif
    </div>
