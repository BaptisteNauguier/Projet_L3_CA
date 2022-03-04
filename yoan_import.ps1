Add-Type -AssemblyName System.Windows.Forms
$Atraiter = Import-CSV -Path "D:\Users\Yoan\Desktop\Test\MaListe.txt" -Delimiter ";"
$FichierdeSortie = "D:\Users\Yoan\Desktop\Test\TestEnCours.txt" ; if (Test-Path $FichierdeSortie){Remove-Item -Path $FichierdeSortie -Force}
Write-Output "ID;Lien;Erreur" >> $FichierdeSortie
ForEach($Ligne in $Atraiter) {
        $LienEnCours = $Ligne.Lien ; $IdEnCours = $Ligne.ID
        Write-Host "Accéss $EnCours en cours... pour l'ID $IdEnCours"
    [System.Windows.Forms.Clipboard]::Clear()
    start-process -filepath "C:\Program Files (x86)\Google\Chrome\Application\chrome.exe" -ArgumentList "$LienEnCours -private"
    Start-Sleep -Seconds 10
    $WShell = New-Object -ComObject Wscript.Shell;
    $WShell.AppActivate('Google Chrome')
    Start-Sleep -Seconds 10
    $WShell.SendKeys('{TAB}{TAB}{TAB}{TAB} ')
    Start-Sleep -Seconds 10
    $WShell.SendKeys('{TAB} ')
    Start-Sleep -Seconds 10
    $WShell.SendKeys('{TAB} ')
    Start-Sleep -Seconds 10
    $WShell.SendKeys(' ')
    Start-Sleep -Seconds 10
    $WShell.SendKeys('{TAB}{TAB}{TAB} ')
    Start-Sleep -Seconds 10
    $WShell.SendKeys('%{F4}')
    $PressePapier = Get-Clipboard ; 
    if (-not($null -eq $PressePapier)){$Resultat = $IdEnCours +";"+$PressePapier ;$Resultat >> $FichierdeSortie }
}
$NombreDeLigne = (Get-Content $FichierdeSortie).count -1
[System.Windows.Forms.MessageBox]::Show("C'est fini avec $NombreDeLigne lignes traitées","Terminé",0,64)
