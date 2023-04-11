export default function TextField() {
  return {
    MuiTextField: {
      styleOverrides: {
        root: {
          '&.colorPicker': {
            'input[type="setting"]': {
              fontSize: '14px',
              textAlign: 'center',
              height: '49px',
              padding: '0px',
              '::placeholder': {
                opacity: 1
              }
            },
            '.MuiInputBase-root': {
              height: '49px',
              borderRadius: '0',
              order: 2
            },
            '.MuiFormHelperText-root': {
              margin: 0
            }
          },

          '& .MuiInputBase-root': {
            height: '100%',
            minHeight: '49px'
          },
          '&:hover': {
            borderColor: 'rgba(0, 0, 0, 0.23)'
          },
          '& input.MuiInputBase-input, & textarea.MuiInputBase-input': {
            border: 'none',
            '&:focus': {
              boxShadow: 'none'
            },
            backrgoundColor: 'transparent'
          }
        },
        filled: {
          backgroundColor: '#00000017'
        }
      }
    }
  }
}
