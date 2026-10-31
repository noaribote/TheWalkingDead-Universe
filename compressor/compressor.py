import subprocess
from pathlib import Path

RACINE_PROJET = Path(__file__).resolve().parent.parent
DOSSIER = RACINE_PROJET / "video"
HAUTEUR = 320
CRF = 32  # Plus élevé = fichier plus léger, qualité moindre
DEBIT_AUDIO = "64k"
SORTIE = DOSSIER / "compressed"

def main():
    if not DOSSIER.is_dir():
        print(f"Dossier vidéo introuvable : {DOSSIER}")
        return

    videos = sorted(
        video
        for video in DOSSIER.rglob("*.webm")
        if SORTIE not in video.parents
    )

    if not videos:
        print(f"Aucune vidéo WebM trouvée dans {DOSSIER}.")
        return

    for video in videos:
        chemin_relatif = video.relative_to(DOSSIER)
        output = SORTIE / chemin_relatif
        output.parent.mkdir(parents=True, exist_ok=True)

        print(f"Compression : {chemin_relatif}")
        commande = [
            "ffmpeg",
            "-i", str(video),
            "-vf", f"scale=-2:{HAUTEUR}",
            "-c:v", "libvpx-vp9",
            "-crf", str(CRF),
            "-b:v", "0",
            "-c:a", "libopus",
            "-b:a", DEBIT_AUDIO,
            "-deadline", "good",
            "-cpu-used", "4",
            "-y",
            str(output),
        ]
        subprocess.run(commande, check=True)
        print(f"Terminée : {output}")

    print(f"\nCompression terminée : {len(videos)} vidéo(s).")


if __name__ == "__main__":
    main()
