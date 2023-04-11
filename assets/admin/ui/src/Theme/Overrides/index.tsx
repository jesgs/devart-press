// eslint-disable-next-line no-unused-vars
import { Theme } from '@mui/material'
// import Alert from './Alert'
import Button from './components/Button'
// import Divider from './Divider'
// import Select from './Select'
// import RadioGroup from './RadioGroup'
// import Stepper from './Stepper'
// import Switch from './Switch'
import TextField from './components/TextField'
// import CircularProgress from './CircularProgress'

export default function ComponentOverrides(theme: Theme) {
  return Object.assign(
    // Alert(),
    Button(theme),
    // Divider(),
    // RadioGroup(),
    TextField(),
    // CircularProgress(),
    // Select(),
    // Stepper(theme),
    // Switch(theme)
  )
}
