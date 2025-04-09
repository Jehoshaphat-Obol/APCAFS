# Personality Assessment

## Set up

### Cloning this Repository with Large Files Using Git LFS

This repository utilizes Git Large File Storage (LFS) to manage large files. To clone the repository and retrieve these files correctly, follow these steps:

1.  **Install Git LFS:**

    * If you haven't already, install Git LFS on your system. You can find installation instructions for your operating system on the [Git LFS website](https://git-lfs.github.com/).

2.  **Clone the Repository:**

    * Use the standard `git clone` command to clone the repository:

        ```bash
        git clone https://github.com/Jehoshaphat-Obol/APCAFS.git
        ```

3.  **Install Git LFS in the Cloned Repository (if needed):**

    * Navigate to the cloned repository:

        ```bash
        cd APCAFS
        ```

    * If Git LFS was not automatically initialized during the clone, initialize it:

        ```bash
        git lfs install
        ```

4.  **Pull Large Files:**

    * Git LFS automatically downloads the large files (tracked files) when you checkout the commits that contain them. If for some reason the large files are not downloaded, you can manually pull them using:

        ```bash
        git lfs pull
        ```

    * This command will download the actual content of the large files that are managed by Git LFS.

5.  **Verify Large Files:**

    * After pulling, verify that the large files are present and have the correct size. You should see the actual file content, not just Git LFS pointer files.

**Important Notes:**

* Ensure that Git LFS is installed *before* you clone the repository to avoid potential issues.
* If you encounter any issues with large files not downloading, double-check that Git LFS is properly installed and initialized.
* If you are behind a proxy, make sure git lfs is configured to use the proxy.

### Intergration with X

To run the code, use `pip install “twikit==1.7.6”` to install the _twikit_ package. The latest update of _twikit_ 
deprecated the synchronous method which is used in the code.

Check out the supplementary YouTube tutorial: https://youtu.be/6D6fVyFQD5A

### Dataset
[MBTI (Myers–Briggs Type Indicator) dataset](https://www.kaggle.com/datasets/datasnaek/mbti-type)

# Frontend

please read through [the cloning process](#cloning-this-repository-with-large-files-using-git-lfs) before proceeding


## Set up
In the directory '/frontend/' run the following commands

**Install dependencies**
```shell
npm install
````

**Run development Server**
```shell
npm run dev
```

## Project Structure

- `frontend/src/services/` - This is where services that are used in many componenets are stored e.g Networking, Authentication, Authorization etc.
- `frontend/src/routes/` - In this folder all routes shall be registered.
- `frontend/src/layouts/` - a folder containing various layouts to be used by pages
- `frontend/src/pages/` - a folder containing all pages for the project.
-  `frontend/src/components/` - a folder containing all ui components
- `frontend/src/assets/` - a folder containing media assets for the project.