import Button from "@mui/material/Button"
import TextField from "@mui/material/TextField"
import React from "react"


function App() {
  return(
      <div>
        <h1>WordPress to DeviantArt Settings</h1>
        <p><Button variant="outlined" href="/get-authorization">Connect to DeviantArt</Button></p>
        <p><TextField id="devart-client-id" label="DeviantArt App Client ID" variant="outlined" /></p>
        <p><TextField id="devart-client-secret" label="DeviantArt App Client ID" variant="outlined" /></p>
        <p><Button variant="outlined">Save Settings</Button></p>
      </div>
  )
}

export default App
