import React from 'react'
import {
  StyledEngineProvider,
  createTheme, // eslint-disable-next-line no-unused-vars
  ThemeOptions,
  ThemeProvider as MUIThemeProvider
} from '@mui/material/styles'

import componentOverrides from './Overrides'

type ThemeProviderProps = {
  children: React.ReactNode
}

export default function ThemeProvider({ children }: ThemeProviderProps) {
  const themeOptions: ThemeOptions = {
    shape: {
      borderRadius: 5
    },
    spacing: [6, 12, 24, 36, 48],
    typography: {
      button: {
        textTransform: 'none'
      }
    }
  }

  const theme = createTheme(themeOptions)
  theme.components = { ...theme.components, ...componentOverrides(theme) }

  const themeOption2: ThemeOptions = {
    // palette,
    shape: {
      borderRadius: 5
    },
    spacing: [6, 12, 24, 36, 48],
    typography: {
      button: {
        textTransform: 'none'
      }
    }
  }

  const theme2 = createTheme(themeOption2)
  theme2.components = componentOverrides(theme2)

  return (
    <StyledEngineProvider injectFirst>
      <MUIThemeProvider theme={theme}>{children}</MUIThemeProvider>
    </StyledEngineProvider>
  )
}
