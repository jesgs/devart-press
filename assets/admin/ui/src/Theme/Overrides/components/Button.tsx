// eslint-disable-next-line no-unused-vars
import { Theme } from '@mui/material/styles'

export default function Button(theme: Theme) {
  return {
    variants: [
      {
        props: { variant: 'copy' }
      }
    ],
    MuiButton: {
      styleOverrides: {
        root: {
          borderRadius: '100px',
          color: '#FFFFFF',
          fontWeight: 700,
          paddingLeft: '30px',
          paddingRight: '30px',

          '&:hover': {
            boxShadow:
              '0px 2px 4px -1px rgba(0, 0, 0, 0.2), 0px 4px 5px rgba(0, 0, 0, 0.14), 0px 1px 10px rgba(0, 0, 0, 0.12);'
          },
          '&:disabled': {
            backgroundColor: '#0000001F',
            boxShadow: 'none'
          }
        },

        // sizes
        sizeLarge: {
          height: '54px',
          fontSize: '18px'
        },
        sizeMedium: {
          height: '39px',
          fontSize: '16px',
          fontWeight: 700
        },
        sizeSmall: {
          height: '30px',
          fontSize: '14px',
          fontWeight: 700
        },

        // copy button
        copy: {
          borderRadius: '5px',
          border: '1px solid #E1E1E1',
          color: 'darkGrey',
          padding: '12px',
          textAlign: 'left',
          justifyContent: 'space-between',

          '&:hover': {
            boxShadow: 'none'
          }
        },

        // contained
        contained: {
          backgroundColor: theme.palette.primary.main,
          [theme.breakpoints.down('md')]: {
            lineHeight: 1
          },
          '&:hover': {
            backgroundColor: theme.palette.primary.dark
          }
        },
        containedPrimary: {
          backgroundColor: theme.palette.primary.main,

          '&:hover': {
            backgroundColor: theme.palette.primary.dark
          }
        },
        containedSecondary: {
          backgroundColor: theme.palette.secondary.main,

          '&:hover': {
            backgroundColor: theme.palette.secondary.dark
          }
        },
        containedWarning: {
          backgroundColor: theme.palette.warning.main,

          '&:hover': {
            backgroundColor: theme.palette.warning.dark
          }
        },
        containedSuccess: {
          backgroundColor: theme.palette.success.main,

          '&:hover': {
            backgroundColor: theme.palette.success.dark
          }
        },
        containedError: {
          backgroundColor: theme.palette.error.main,

          '&:hover': {
            backgroundColor: theme.palette.error.dark
          }
        },
        containedInfo: {
          backgroundColor: theme.palette.info.main,

          '&:hover': {
            backgroundColor: theme.palette.info.dark
          }
        },

        // outlined
        outlined: {
          backgroundColor: 'transparent',
          baxShadow: 'none',

          '&:hover': {
            backgroundColor: '#rgba(65, 164, 169, 0.08)',
            boxShadow: 'none'
          },
          '&:disabled': {
            backgroundColor: 'transparent'
          }
        },
        outlinedPrimary: {
          color: theme.palette.primary.main,
          borderColor: theme.palette.primary.main,

          '&:hover': {
            backgroundColor: '#41A4A914'
          }
        },
        outlinedWarning: {
          color: theme.palette.warning.main,
          borderColor: theme.palette.warning.main,

          '&:hover': {
            backgroundColor: '#E5BF6414'
          }
        },
        outlinedSuccess: {
          color: theme.palette.success.main,
          borderColor: '#CDF5E3',

          '&:hover': {
            backgroundColor: '#4CAF5014',
            borderColor: '#CDF5E3'
          }
        },
        outlinedError: {
          color: theme.palette.error.main,
          borderColor: theme.palette.error.main,

          '&:hover': {
            backgroundColor: '#F4433614'
          }
        },
        outlinedSecondary: {
          color: theme.palette.secondary.main,
          borderColor: theme.palette.secondary.main,

          '&:hover': {
            backgroundColor: '#E5633814'
          }
        },
        outlinedInfo: {
          color: theme.palette.info.main,
          borderColor: theme.palette.info.main,

          '&:hover': {
            backgroundColor: theme.palette.info.dark,
            color: '#ffffff'
          }
        },

        // text
        text: {
          backgroundColor: 'transparent',

          '&:hover': {
            boxShadow: 'none'
          }
        },
        textPrimary: {
          color: theme.palette.primary.main,

          '&:hover': {
            backgroundColor: '#41A4A914'
          }
        },
        textSecondary: {
          color: theme.palette.secondary.main,

          '&:hover': {
            backgroundColor: '#E5633814'
          }
        },
        textWarning: {
          color: theme.palette.warning.main,

          '&:hover': {
            backgroundColor: '#E5BF6414'
          }
        },
        textSuccess: {
          color: theme.palette.success.main,

          '&:hover': {
            backgroundColor: '#4CAF5014'
          }
        },
        textError: {
          color: theme.palette.error.main,

          '&:hover': {
            backgroundColor: '#F4433614'
          }
        }
      }
    }
  }
}
